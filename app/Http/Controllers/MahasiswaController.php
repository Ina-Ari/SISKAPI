<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Kegiatan;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();

        // Filter mahasiswa berdasarkan jurusan jika ada parameter 'jurusan'
        $query = Mahasiswa::query();

        if ($request->has('jurusan') && $request->jurusan != 'all') {
            $query->where('kode_jurusan', $request->jurusan);
        }

        // Ambil data mahasiswa (dengan filter jika ada)
        $data = $query->with(['prodi', 'jurusan'])->has('kegiatan')->get();

        $status = [];

        foreach ($data as $mahasiswa) {

            $totalPoin = 0;

            foreach ($mahasiswa->kegiatan as $kegiatan) {
                if ($kegiatan->verif === 'True') {
                    $totalPoin += $kegiatan->Poin->poin;
                }
            }

            $keterangan = $totalPoin >= 28 ? 'Lulus' : 'Belum Lulus';

            $status[$mahasiswa->nim] = [
                'keterangan' => $keterangan,
                // 'totalPoin' => $totalPoin
            ];
        }

        return view('daftarmahasiswa', compact('data', 'status', 'jurusan'));
    }

    public function kegiatan($id, Request $request)
    {
        $filter = $request->get('filter', 'all');

        // Ambil data mahasiswa beserta kegiatan yang difilter
        $query = Mahasiswa::with(['kegiatan' => function ($q) use ($filter) {
            if ($filter === 'True') {
                $q->where('verif', 'True');
            } elseif ($filter === 'False') {
                $q->where('verif', 'False');
            }
        }])->findOrFail($id);

        // dd($query);

        return view('kegiatanmahasiswa', compact('query'))->with('filter', $filter);

    }

    public function indexMhs()
    {
        if (!session()->has('nama')) {
            return redirect()->route('loginmhs');
        }

        $nim = session('nim');

        // Ambil data mahasiswa berdasarkan nim dari sesi
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            // Jika data mahasiswa tidak ditemukan, redirect ke halaman login
            return redirect()->route('loginmhs')->withErrors(['error' => 'Mahasiswa tidak ditemukan.']);
        }

        // $nim = session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $kegiatan = DB::table('kegiatan')
            ->join('tingkat_kegiatan', 'kegiatan.idtingkat_kegiatan', '=', 'tingkat_kegiatan.idtingkat_kegiatan')
            ->join('posisi', 'kegiatan.id_posisi', '=', 'posisi.id_posisi')
            ->join('poin', 'kegiatan.id_poin', '=', 'poin.id_poin')
            ->where('kegiatan.nim', $nim)
            ->select('kegiatan.*', 'tingkat_kegiatan.tingkat_kegiatan', 'posisi.nama_posisi', 'poin.poin')
            ->get();

        // Kalkulasi total poin untuk kegiatan yang terverifikasi
        $totalPoin = $kegiatan->filter(function ($item) {
            return $item->verif === 'True'; // Or use true if the data type is boolean
        })->sum('poin');

        // Hitung total kegiatan terverifikasi yang diajukan oleh mahasiswa
        $totalVerifTrue = $kegiatan->filter(function ($item) {
            return $item->verif === 'True'; // Or use true if the data type is boolean
        })->count();

        // Hitung total kegiatan yang diajukan oleh mahasiswa
        $totalKegiatan = $kegiatan->count();

        // Kalkulasi total kegiatan yang belum terverifikasi
        $totalVerifFalse = $kegiatan->filter(function ($item) {
            return $item->verif === 'False' || $item->verif == 0; // Memeriksa 'False' atau 0
        })->count();


        $jenjang_pendidikan = $mahasiswa->jenjang_pendidikan;

        //dd(session()->all());
        // dd($nim);

        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();

        return view('mhs.dashboardMhs', compact('kegiatan', 'posisi', 'tingkatKegiatan', 'jenisKegiatan', 'nim', 'mahasiswa', 'totalPoin', 'totalVerifTrue', 'totalKegiatan', 'totalVerifFalse', 'jenjang_pendidikan'));
    }

}
