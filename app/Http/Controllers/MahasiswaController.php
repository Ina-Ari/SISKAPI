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
}
