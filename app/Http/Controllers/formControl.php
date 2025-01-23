<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\JenisKegiatan;
use App\Models\kegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;
use App\Models\Mahasiswa;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\DB;


class formControl extends Controller
{
    public function indexMahasiswa()
    {
        // $mahasiswa = session()->has('nim');
        $data = Poin::with(['posisi', 'tingkatKegiatan', 'jenisKegiatan'])->get();
        $posisi = Posisi::all(); // Data untuk dropdown posisi
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        // $kegiatan = Kegiatan::where('nim',$mahasiswa)->get();

        // dd($posisi);
        // dd($mahasiswa);

        return view('mhs.dashboardMhs', compact('data', 'posisi', 'tingkatKegiatan', 'jenisKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $nim = session('nim');
        // Validasi data
        $request->validate([
            'Nim' => 'required|string|max:255',
            'Nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'id_posisi' => 'required|exists:posisi,id_posisi',
            'idtingkat_kegiatan' => 'required|exists:tingkat_kegiatan,idtingkat_kegiatan',
            'idjenis_kegiatan' => 'required|exists:jenis_kegiatan,idjenis_kegiatan',
            'sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Simpan file sertifikat ke direktori public
        $certificate = $request->file('sertifikat');
        $certificatePath = $certificate->store('sertifikat', 'public');  // 'public' berarti di direktori storage/app/public

        // Path absolut untuk script Python dan file sertifikat
        $pythonScriptPath = base_path('resources/python/verify_certificate.py');
        $certificateAbsolutePath = public_path('storage/' . $certificatePath); // Pastikan path file sesuai

        // Menjalankan script Python dengan menggunakan perintah py (atau python, tergantung sistem)
        $process = new Process(['py', $pythonScriptPath, $certificateAbsolutePath]); // Ganti 'python' dengan 'py' jika itu yang berfungsi
        $process->run();

        // Tangani error jika script Python gagal
        if (!$process->isSuccessful()) {
            // Jika Python script gagal, tangani dengan exception
            throw new ProcessFailedException($process);
        }

        // Ambil hasil dari output script Python (apakah sertifikat terverifikasi atau tidak)
        $verificationResult = trim($process->getOutput());
        $isVerified = $verificationResult === "Terverifikasi";

        // Log hasil verifikasi
        if ($isVerified) {
            Log::info("Certificate verified successfully for Nim: {$request->Nim}");
        } else {
            Log::warning("Certificate verification failed for Nim: {$request->Nim}");
        }

        // Mencari id_poin berdasarkan kombinasi
        $poin = Poin::where('id_posisi', $request->id_posisi)
            ->where('idtingkat_kegiatan', $request->idtingkat_kegiatan)
            ->where('idjenis_kegiatan', $request->idjenis_kegiatan)
            ->first();

        // Cek apakah id_poin ditemukan
        if (!$poin) {
            return redirect()->back()->withErrors(['msg' => 'Poin tidak ditemukan untuk kombinasi yang diberikan.']);
        }

        // Simpan data ke database
        Kegiatan::create([
            'Nim' => $request->Nim,
            'nama_kegiatan' => $request->Nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'id_posisi' => $request->id_posisi,
            'idtingkat_kegiatan' => $request->idtingkat_kegiatan,
            'idjenis_kegiatan' => $request->idjenis_kegiatan,
            'sertifikat' => 'storage/' . $certificatePath, // Simpan path relatif
            'verifsertif' => $isVerified,
            'verif' => false,
            'id_poin' => $poin->id_poin,
        ]);

        return redirect()->route('indexMhs')->with('success', 'Kegiatan berhasil disimpan.');
    }

    public function updateKegiatan(Request $request, $id_kegiatan)
    {
        $nim = session('nim');
        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'id_posisi' => 'required|exists:posisi,id_posisi',
            'idtingkat_kegiatan' => 'required|exists:tingkat_kegiatan,idtingkat_kegiatan',
            'idjenis_kegiatan' => 'required|exists:jenis_kegiatan,idjenis_kegiatan',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Cari data kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);

        // Jika ada file sertifikat baru, lakukan pengunggahan dan penggantian
        if ($request->hasFile('sertifikat')) {
            // Direktori tujuan
            $destinationPath = public_path('image/sertifikat');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // File sertifikat
            $file = $request->file('sertifikat');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileName = $originalName . '.' . $extension;

            // Pastikan nama file unik
            $counter = 1;
            while (file_exists($destinationPath . '/' . $fileName)) {
                $fileName = $originalName . '_' . $counter++ . '.' . $extension;
            }

            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $fileName);

            // Path lengkap sertifikat
            $filePath = 'image/sertifikat/' . $fileName;

            // Path ke logo
            $logoPath = public_path('image/logo_pnb.jpg');
            $certificatePath = public_path($filePath);

            // Jalankan skrip Python untuk verifikasi sertifikat
            $output = shell_exec("python3 /path/to/your/detect_logo.py " . escapeshellarg($logoPath) . " " . escapeshellarg($certificatePath));

            // Cek hasil dari skrip Python
            $isVerified = trim($output) === "True";

            // Log hasil verifikasi
            if ($isVerified) {
                Log::info("Certificate verified successfully for Nim: {$request->Nim}");
            } else {
                Log::warning("Certificate verification failed for Nim: {$request->Nim}");
            }

            // Hapus file sertifikat lama jika ada
            if ($kegiatan->sertifikat && file_exists(public_path($kegiatan->sertifikat))) {
                unlink(public_path($kegiatan->sertifikat));
            }

            // Update path sertifikat dan status verifikasi
            $kegiatan->sertifikat = $filePath;
            $kegiatan->verifsertif = $isVerified;  // Menyimpan hasil verifikasi
        }

        // Mencari id_poin berdasarkan kombinasi
        $poin = Poin::where('id_posisi', $request->id_posisi)
            ->where('idtingkat_kegiatan', $request->idtingkat_kegiatan)
            ->where('idjenis_kegiatan', $request->idjenis_kegiatan)
            ->first();

        // Cek apakah id_poin ditemukan
        if (!$poin) {
            return redirect()->back()->withErrors(['msg' => 'Poin tidak ditemukan untuk kombinasi yang diberikan.']);
        }

        // Update data kegiatan
        $kegiatan->update([
            'nim' => $request->nim,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'id_posisi' => $request->id_posisi,
            'idtingkat_kegiatan' => $request->idtingkat_kegiatan,
            'idjenis_kegiatan' => $request->idjenis_kegiatan,
            'id_poin' => $poin->id_poin,
            'verif' => 'False', // Reset verifikasi manual jika ada update
        ]);

        // dd($request->all());

        return redirect()->route('indexMhs')->with('success', 'Kegiatan berhasil diperbarui.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $kegiatan = DB::table('kegiatan')
        ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin') 
        ->where('kegiatan.nim', $nim)
        ->select('kegiatan.*','poin.poin')
        ->get();

        // Kalkulasi total poin untuk kegiatan yang terverifikasi
        $totalPoin = $kegiatan->filter(function ($item) {
            return $item->verif === 'True'; // Or use true if the data type is boolean
        })->sum('poin');
        return view('mhs.profileMhs', compact('mahasiswa', 'totalPoin'));
    }

    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $request->validate([
            'foto_profil' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:10',
            'no_telepon' => 'required|string|max:30',
            'email' => 'required|email',
            // 'jurusan' => 'required|string|max:100',
            // 'jenjang_pendidikan' => 'required|string|max:50',
            // 'kode_jurusan' => 'required|string|max:100',
            // 'kode_prodi' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('fotoprofil', 'public');
            $mahasiswa->foto_profil = $path;
        }

        $mahasiswa->update($request->except('foto_profil'));
        return redirect()->route('form.edit', $nim)->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
