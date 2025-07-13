<?php

namespace App\Http\Controllers;

use App\Models\FormKaprodi;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Role;
use App\Models\Skpi;
use App\Models\User;
use App\Services\Skpi\SkpiDocumentServiceInterface;
use App\Support\Resolvers\UserRelationResolver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class SkpiController extends Controller
{
    public function __construct(
        private SkpiDocumentServiceInterface $skpiDocumentService
    ) {
    }

    /**
     * Kepala Prodi Service
     */
    public function showSkpiMahasiswaKaprodiView(Request $request)
    {
        $data = $request->validate([
            'status' => 'nullable|in:Menunggu,Diajukan,Revisi,Selesai',
            'angkatan' => 'nullable|numeric|digits:5'
        ]);

        $status = $data['status'] ?? null;
        $angkatan = $data['angkatan'] ?? null;

        $prodi = UserRelationResolver::getRelationData(Auth::user())->prodi;
        $kode_prodi = $prodi->kode_prodi;
        $templateFilename = config('skpi.template.prefix') . $kode_prodi . config('skpi.template.preview.extension');
        $templateFullPath = config('skpi.template.preview.path') . $templateFilename;
        $targetPoin = match ($prodi->jenjang) {
            'D4' => 28,
            'D3' => 24,
            'D2' => 0
        };

        $mahasiswa = User::with('mahasiswa.kegiatan.poin')
            ->where('role_id', Role::getId(Role::MAHASISWA))
            ->whereHas('mahasiswa', function ($query) use ($data, $kode_prodi) {
                $query->where('kode_prodi', $kode_prodi)
                    ->when(!empty($data['angkatan']), function ($q) use ($data) {
                        $q->where('angkatan', $data['angkatan']);
                    })
                    ->when(!empty($data['status']), function ($q) use ($data) {
                        $q->whereHas('skpi', function ($subQ) use ($data) {
                            $subQ->where('status', $data['status']);
                        });
                    })
                    ->whereHas('kegiatan', function ($query) {
                        $query->where('status', 'true');
                    });
            })
            ->get()
            ->filter(function ($user) use ($targetPoin) {
                $totalPoin = $user->mahasiswa->kegiatan->sum(function ($kegiatan) {
                    return $kegiatan->poin->poin ?? 0;
                });
                return $totalPoin >= $targetPoin;
            });

        $angkatanList = Mahasiswa::where('kode_prodi', $kode_prodi)
            ->distinct()
            ->pluck('angkatan')
            ->sort()
            ->values();

        return view('kaprodi.SkpiMahasiswaKaprodi', compact('templateFullPath', 'mahasiswa', 'angkatanList', 'angkatanList', 'status', 'angkatan'));
    }

    public function createTemplate(Request $request)
    {
        $data = $request->validate([
            'template' => ['required', File::types('docx')->max(2 * 1024)],
            'nama_kajur' => ['required', 'max:200'],
            'nip_kajur' => ['required', 'digits:18']
        ]);


        try {
            $prodi = UserRelationResolver::getRelationData(Auth::user())->prodi;
            $jurusan = $prodi->jurusan;

            $templateFile = $data['template'];
            $templateData = [
                'kode_prodi' => $prodi->kode_prodi,
                'nama_kajur' => $data['nama_kajur'],
                'nip_kajur' => $data['nip_kajur'],
                'prodi_id' => $prodi->nama_prodi,
                'prodi_en' => $prodi->prodi_name,
                'jurusan_id' => $jurusan->nama_jurusan,
                'jurusan_en' => $jurusan->jurusan_name,
            ];

            $this->skpiDocumentService->uploadTemplate($templateFile, $templateData);

            return back()->with('success', 'Template berhasil di upload!');
        } catch (\Exception $e) {
            return back()->withErrors(['template' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'nim' => ['required', 'digits:10', 'numeric']
        ]);

        try {
            $mahasiswa = Mahasiswa::with('kegiatan')
                ->where('nim', $data['nim'])
                ->first();
            $kegiatan = $mahasiswa->kegiatan()
                ->with('poin.jenisKegiatan')
                ->where('status', 'true')->get();

            $kode_prodi = UserRelationResolver::getRelationData(Auth::user())->prodi->kode_prodi;
            $form = FormKaprodi::where('kode_prodi', $kode_prodi)->first();

            if (!$form) {
                throw new \Exception('Formulir SKPI masih kosong! isi terlebih dahulu');
            }

            $injectData = $this->prepareSkpiCreationData($mahasiswa, $kegiatan, $form);

            $filename = config('skpi.template.prefix') . $kode_prodi . config('skpi.template.generate.extension');
            $templateFullPath = Storage::disk('local')->path(config('skpi.template.generate.path') . $filename);
            $skpiSavePath = Storage::disk('public')->path(config('skpi.save_path'));

            $docxFilePath = $this->skpiDocumentService->fillTemplate(
                $templateFullPath,
                $skpiSavePath,
                $mahasiswa->nim,
                $injectData['singleData'],
                $injectData['numberingData']
            );

            $this->skpiDocumentService->convertToPDF($docxFilePath, $skpiSavePath, str_replace('docx', 'pdf', $filename));

            $mahasiswa->skpi()->updateOrCreate([
                'mahasiswa_id' => $mahasiswa->user_id
            ], [
                'kepala_prodi_id' => Auth::user()->id,
                'link' => asset('storage/' . config('skpi.save_path') . config('skpi.prefix') . $data['nim'] . '.pdf'),
                'status' => 'Diajukan'
            ]);

            return back()->with('success', 'Dokumen SKPI Mahasiswa berhasil dibuat!');;
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function prepareSkpiCreationData(Mahasiswa $mahasiswa, Collection|Kegiatan $kegiatan, FormKaprodi $form): array
    {
        $organisasi = $kegiatan->filter(function ($item) {
            return $item->poin?->jenisKegiatan->kategori_skpi === 'organisasi';
        });
        $aktivitas = $kegiatan->filter(function ($item) {
            return $item->poin?->jenisKegiatan->kategori_skpi === 'aktivitas';
        });
        $pelatihan = $kegiatan->filter(function ($item) {
            return $item->poin?->jenisKegiatan->kategori_skpi === 'pelatihan';
        });
        $kerja = $kegiatan->filter(function ($item) {
            return $item->poin?->jenisKegiatan->kategori_skpi === 'kerja';
        });

        $formatKegiatanId = fn($collection) =>
            $collection->map(fn($item) => htmlspecialchars($item->nama_kegiatan))
                ->values()->all();

        \Log::info(json_encode($formatKegiatanId($aktivitas)));

        $formatKegiatanEn = fn($collection) =>
            $collection->map(fn($item) => htmlspecialchars($item->kegiatan_name))
                ->values()->all();

        return [
            'singleData' => [
                'nama_mahasiswa' => $mahasiswa->user->nama,
                'tempat_lahir' => $mahasiswa->tempat_lahir,
                'tanggal_lahir_id' => $mahasiswa->tanggal_lahir->locale('id')->translatedFormat('j F Y'),
                'tanggal_lahir_en' => $mahasiswa->tanggal_lahir->format('F j, Y'),
                'nim' => $mahasiswa->nim,
                'akreditasi_id' => $form->akreditasi_institusi,
                'akreditasi_en' => $form->institution_acc,
                'kkni_level_id' => $form->kualifikasi_kkni,
                'kkni_level_en' => $form->kkni_level,
                'syarat_id' => $form->persyaratan_penerimaan,
                'syarat_en' => $form->adminission_requirement,
                'bahasa_id' => $form->bahasa_pengantar,
                'bahasa_en' => $form->instruction_language,
                'jenis_pendidikan_id' => $form->jenis_pendidikan,
                'jenis_pendidikan_en' => $form->education_type,
                'gelar_id' => $form->gelar,
                'gelar_en' => $form->degree,
                'lama_studi_id' => $form->lama_studi,
                'lama_studi_en' => $form->length_study,
                'created_at_id' => now()->locale('id')->translatedFormat('j, F Y'),
                'created_at_en' => now()->format('F j, Y'),
            ],
            'numberingData' => [
                'sikap_id' => $form->sikap,
                'sikap_en' => $form->attitude,
                'pengetahuan_id' => $form->penguasaan_pengetahuan,
                'pengetahuan_en' => $form->knowledge,
                'keterampilan_umum_id' => $form->keterampilan_umum,
                'keterampilan_umum_en' => $form->general_skills,
                'keterampilan_khusus_id' => $form->keterampilan_khusus,
                'keterampilan_khusus_en' => $form->special_skills,
                'organisasi_id' => $formatKegiatanId($organisasi),
                'organisasi_en' => $formatKegiatanEn($organisasi),
                'aktivitas_id' => $formatKegiatanId($aktivitas),
                'aktivitas_en' => $formatKegiatanEn($aktivitas),
                'pelatihan_id' => $formatKegiatanId($pelatihan),
                'pelatihan_en' => $formatKegiatanEn($pelatihan),
                'kerja_id' => $formatKegiatanId($kerja),
                'kerja_en' => $formatKegiatanEn($kerja),
            ]
        ];
    }


    /**
     * BAAK Service
     */
    public function showSkpiMahasiswaBaakView(Request $request)
    {
        $data = $request->validate([
            'status' => 'nullable|in:Diajukan,Revisi,Selesai',
            'angkatan' => 'nullable|numeric|digits:5',
            'prodi' => 'nullable|string'
        ]);

        $status = $data['status'] ?? null;
        $angkatan = $data['angkatan'] ?? null;
        $prodi = $data['prodi'] ?? null;

        $mahasiswa = User::with(['mahasiswa.kegiatan.poin'])
            ->where('role_id', Role::getId(Role::MAHASISWA))
            ->whereHas('mahasiswa', function ($query) use ($data) {
                $query->when(!empty($data['angkatan']), function ($q) use ($data) {
                    $q->where('angkatan', $data['angkatan']);
                })
                    ->when(!empty($data['status']), function ($q) use ($data) {
                        $q->whereHas('skpi', function ($subQ) use ($data) {
                            $subQ->where('status', $data['status']);
                        });
                    })
                    ->when(empty($data['status']), function ($q) use ($data) {
                        $q->whereHas('skpi', function ($subQ) use ($data) {
                            $subQ->orWhere('status', 'Diajukan');
                            $subQ->orWhere('status', 'Revisi');
                        });
                    })
                    ->when(!empty($data['prodi']), function ($q) use ($data) {
                        $q->whereHas('prodi', function ($subQ) use ($data) {
                            $subQ->where('nama_prodi', $data['prodi']);
                        });
                    })
                    ->whereHas('kegiatan', function ($query) {
                        $query->where('status', 'true');
                    });
            })
            ->get();

        $angkatanList = Mahasiswa::distinct()
            ->pluck('angkatan')
            ->sort()
            ->values();

        $prodiList = Prodi::distinct()
            ->pluck('nama_prodi')
            ->sort()
            ->values();

        return view('baak.SkpiMahasiswaBaak', compact('mahasiswa', 'angkatanList', 'prodiList', 'angkatanList', 'status', 'angkatan', 'prodi'));
    }

    public function verification(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|numeric|digits:10',
            'nomor_skpi' => 'required|numeric',
            'nomor_ijazah' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_lulus' => 'required|date',
        ]);

        try {
            $mahasiswa = Mahasiswa::with('skpi')->where('nim', $data['nim'])->first();

            $isNomorSkpiExist = Skpi::where('nomor_skpi', $data['nomor_skpi'])
                ->where('mahasiswa_id', '!=', $mahasiswa->mahasiswa_id)
                ->exists();

            if ($isNomorSkpiExist) {
                throw new \Exception('Nomor SKPI sudah digunakan!');
            }

            $templateFilename = config('skpi.prefix') . $data['nim'] . config('skpi.template.generate.extension');
            $templateFullPath = Storage::disk('public')->path(config('skpi.save_path') . $templateFilename);

            $injectData = [
                'nomor_skpi' => $data['nomor_skpi'],
                'nomor_ijazah' => $data['nomor_ijazah'],
                'tanggal_masuk_id' => Carbon::parse($data['tanggal_masuk'])->locale('id')->translatedFormat('j F, Y'),
                'tanggal_masuk_en' => Carbon::parse($data['tanggal_masuk'])->format('F, j Y'),
                'tanggal_lulus_id' => Carbon::parse($data['tanggal_lulus'])->locale('id')->translatedFormat('j F, Y'),
                'tanggal_lulus_en' => Carbon::parse($data['tanggal_lulus'])->format('F, j Y'),
            ];

            $skpiSavePath = Storage::disk('public')->path(config('skpi.final_path'));

            $docxFullPath = $this->skpiDocumentService->fillTemplate($templateFullPath, $skpiSavePath, $data['nim'], $injectData);

            $saveFilename = config('skpi.prefix') . $data['nim'] . '.pdf';

            $this->skpiDocumentService->convertToPDF($docxFullPath, $skpiSavePath);

            $mahasiswa->skpi->update([
                'nomor_skpi' => $data['nomor_skpi'],
                'nomor_ijazah' => $data['nomor_ijazah'],
                'link' => asset('storage/' . config('skpi.final_path') . $saveFilename),
                'status' => 'Selesai'
            ]);

            return back()->with('success', 'Dokumen SKPI Mahasiswa berhasil diverifikasi!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function revision(Request $request)
    {
        $data = $request->validate([
            'comment' => '',
        ]);

        // Kirim Notifikasi & Rubah Status SKPI ke Revisi
    }
}
