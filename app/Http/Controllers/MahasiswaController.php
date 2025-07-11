<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Poin;
use App\Models\Kegiatan;
use App\Models\Posisi;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        $kegiatan = $mahasiswa->kegiatan->sortByDesc('created_at');

        $jumlah_kegiatan = $mahasiswa->kegiatan()->count();

        $jumlah_kegiatan_acc = $mahasiswa->kegiatan()->where('status', 'true')->count();

        $jumlah_kegiatan_nonacc = $mahasiswa->kegiatan()->where('status', 'false')->count();

        $jumlah_poin = Kegiatan::where('nim', $mahasiswa->user_id)->where('status', 'true')->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin')->sum('poin.poin');

        $jenjang_pendidikan = $mahasiswa->prodi->jenjang;

        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();

        return view('mhs.dashboardMhs', compact('user', 'mahasiswa', 'kegiatan', 'jenjang_pendidikan', 'posisi', 'tingkatKegiatan', 'jenisKegiatan', 'jumlah_poin', 'jumlah_kegiatan', 'jumlah_kegiatan_acc', 'jumlah_kegiatan_nonacc'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $nim = $user->mahasiswa->user_id;
        // Validasi data
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'kegiatan_name' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'id_posisi' => 'required|exists:posisi,id_posisi',
            'idtingkat_kegiatan' => 'required|exists:tingkat_kegiatan,idtingkat_kegiatan',
            'idjenis_kegiatan' => 'required|exists:jenis_kegiatan,idjenis_kegiatan',
            'sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Simpan file sertifikat ke direktori public
        $certificate = $request->file('sertifikat');
        $certificatePath = $certificate->store('sertifikat', 'public'); // 'public' berarti di direktori storage/app/public

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
        $verificationOutput = trim($process->getOutput());
        [$verificationResult, $matchPercentage] = explode('|', $verificationOutput); // Misalnya output dipisahkan dengan "|"
        $certificateStatus = $verificationResult === 'Terverifikasi' ? 'true' : 'false';

        // Mencari id_poin berdasarkan kombinasi
        $poin = Poin::where('id_posisi', $request->id_posisi)->where('idtingkat_kegiatan', $request->idtingkat_kegiatan)->where('idjenis_kegiatan', $request->idjenis_kegiatan)->first();

        // Cek apakah id_poin ditemukan
        if (!$poin) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Poin tidak ditemukan untuk kombinasi yang diberikan.']);
        }

        // Simpan data ke database
        Kegiatan::create([
            'nim' => $nim,
            'nama_kegiatan' => $request->nama_kegiatan,
            'kegiatan_name' => $request->kegiatan_name,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'sertifikat' => $certificatePath, // Simpan path relatif
            'status_sertif' => $certificateStatus,
            'akurasi' => $matchPercentage,
            'status' => 'false',
            'id_poin' => $poin->id_poin,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Kegiatan berhasil disimpan.');
    }

    public function update(Request $request, $id_kegiatan)
    {
        $user = Auth::user();

        $nim = $user->mahasiswa->user_id;

        // Validasi data
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'kegiatan_name' => 'required|string|max:255',
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
            $certificate = $request->file('sertifikat');
            $certificatePath = $certificate->store('sertifikat', 'public'); // 'public' berarti di direktori storage/app/public

            if ($kegiatan->sertifikat && file_exists(public_path('storage/' . $kegiatan->sertifikat))) {
                unlink(public_path('storage/' . $kegiatan->sertifikat));
            }

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
            $verificationOutput = trim($process->getOutput());
            [$verificationResult, $matchPercentage] = explode('|', $verificationOutput); // Misalnya output dipisahkan dengan "|"
            $certificateStatus = $verificationResult === 'Terverifikasi' ? 'true' : 'false';

            // // Update path sertifikat dan status verifikasi
            $kegiatan->sertifikat = $certificatePath;
            $kegiatan->status_sertif = $certificateStatus;
            $kegiatan->akurasi = $matchPercentage; // Menyimpan hasil verifikasi

            $dataUpdate = [
                'sertifikat' => $certificatePath,
                'status_sertif' => $certificateStatus,
                'akurasi' => $matchPercentage,
            ];
        }

        // Mencari id_poin berdasarkan kombinasi
        $poin = Poin::where('id_posisi', $request->id_posisi)->where('idtingkat_kegiatan', $request->idtingkat_kegiatan)->where('idjenis_kegiatan', $request->idjenis_kegiatan)->first();

        // Cek apakah id_poin ditemukan
        if (!$poin) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Poin tidak ditemukan untuk kombinasi yang diberikan.']);
        }

        $dataUpdate = [
            'nim' => $nim,
            'nama_kegiatan' => $request->nama_kegiatan,
            'kegiatan_name' => $request->kegiatan_name,
            'tanggal_kegiatan' => $request->tanggal_kegiatan, // Simpan path relatif
            'id_poin' => $poin->id_poin,
            'status' => 'false',
        ];

        // Update data kegiatan
        $kegiatan->update($dataUpdate);

        // dd($request->all());

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kegiatan = kegiatan::find($id);

        if ($kegiatan->sertifikat && file_exists(public_path('storage/' . $kegiatan->sertifikat))) {
            unlink(public_path('storage/' . $kegiatan->sertifikat));
        }

        $kegiatan->delete();

        return redirect()->route('mahasiswa.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();

        $mahasiswa = $user->mahasiswa;

        $totalPoin = Kegiatan::where('nim', $mahasiswa->user_id)->where('status', 'true')->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin')->sum('poin.poin');

        return view('mhs.profileMhs', compact('user', 'mahasiswa', 'totalPoin'));
    }

    public function updateProfile(Request $request, $nim)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $request->validate([
            'picture' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:100',
            'telepon' => 'required|string|max:30',
            'email' => 'required|email',
        ]);

        if ($request->hasFile('picture')) {
            $foto = $request->file('picture');
            $fotoPath = $foto->store('fotoprofil', 'public');

            if ($user->picture && file_exists(public_path('storage/' . $user->picture))) {
                unlink(public_path('storage/' . $user->picture));
            }

            // Update user termasuk foto baru
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'picture' => $fotoPath,
            ]);

            // $user->picture = $fotoPath;

        } else {
            // Jika tidak upload foto baru
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);

        }

        // Update tabel mahasiswa
        $mahasiswa->update([
            'telepon' => $request->telepon,
        ]);

        $user->save();
        return redirect()->route('mahasiswa.profile')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }
}
