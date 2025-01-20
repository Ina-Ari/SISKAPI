<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class kegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with(['poin', 'posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->where('verif', 'true')->get();
        return view('kegiatan', compact('kegiatan'));
    }

    public function notVerified()
    {
        $kegiatan = Kegiatan::with(['poin', 'posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->where('verif', '!=', 'true')->get();
        return view('kegiatan_not_verified', compact('kegiatan'));
    }

    public function verifySelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'True']);

        return redirect()->route('kegiatan_not_verified')->with('success', 'Kegiatan berhasil diverifikasi.');
    }

    public function cancelSelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id_kegiatan', $ids)->update(['verif' => 'False']);

        return redirect()->route('kegiatan.index')->with('success', 'Verfikasi kegiatan berhasil dibatalkan.');
    }

    public function tampilan(){
        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        return view('FormKegiatan', compact('posisi', 'tingkatKegiatan', 'jenisKegiatan'));
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'nama_kegiatan' => 'required|string|max:255',
    //         'tanggal_kegiatan' => 'required|date',
    //         'idjenis_kegiatan'  => 'required',
    //         'idtingkat_kegiatan'=> 'required',
    //         'id_posisi'         => 'required',
    //         'sertifikat' => 'required', // Maksimal 2MB
    //     ]);

    //     // Simpan file sertifikat
    //     $certificate = $request->file('sertifikat');
    //     $certificatePath = $certificate->store('sertifikat', 'public');

    //     // Path absolut untuk Python
    //     $pythonScriptPath = base_path('resources/python/verify_certificate.py');
    //     $certificateAbsolutePath = public_path('storage/' . $certificatePath);

    //     // Jalankan script Python untuk verifikasi
    //     $process = new Process(['python', $pythonScriptPath, $certificateAbsolutePath]);
    //     $process->run();

    //     // Tangani error jika script Python gagal
    //     if (!$process->isSuccessful()) {
    //         throw new ProcessFailedException($process);
    //     }

    //     // Ambil hasil verifikasi
    //     $verificationResult = trim($process->getOutput());
    //     $certificateStatus = $verificationResult === "Terverifikasi";

    //     // Simpan data ke database
    //     $activity = Activity::create([
    //         'nama_kegiatan' => $request->nama_kegiatan,
    //         'tanggal_kegiatan' => $request->tanggal_kegiatan,
    //         'sertifikat' => $certificatePath,
    //         'certificate_status' => $certificateStatus,
    //     ]);

    //     // Redirect ke halaman sukses atau tampilkan pesan
    //     return redirect()->back()->with('success', 'Data kegiatan berhasil disimpan!');
    // }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nim' => 'required',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'idjenis_kegiatan'  => 'required',
            'idtingkat_kegiatan'=> 'required',
            'id_posisi'         => 'required',
            'sertifikat' => 'required', // Validasi file
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
        $certificateStatus = $verificationResult === "Terverifikasi" ? 'True' : 'False';

        // Simpan data kegiatan ke database
        $activity = Kegiatan::create([
            'nim' => $request->nim,
            'id_poin' => 3,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'idjenis_kegiatan' => $request->idjenis_kegiatan,
            'idtingkat_kegiatan' => $request->idtingkat_kegiatan,
            'id_posisi' => $request->id_posisi,
            'sertifikat' => $certificatePath,
            'verifsertif' => $certificateStatus,
            'verif' => 'False' // Status terverifikasi atau tidak
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('activities.tampilan')->with('success', 'Data kegiatan berhasil disimpan!');
    }
}
