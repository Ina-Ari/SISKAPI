<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data per bulan dan status
        $data = DB::table('skpi')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, status, COUNT(*) as total')
            ->groupBy('bulan', 'status')
            ->orderBy('bulan')
            ->get();

        // Ambil bulan unik dan ubah ke format tanggal lengkap (YYYY-MM-01)
        $tanggalLabels = $data->pluck('bulan')->unique()->map(function ($item) {
            return $item . '-01';
        })->values()->all();

        // Siapkan dataset untuk setiap status
        $datasets = [
            'total_pengajuan' => [],
            'proses_verifikasi' => [],
            'telah_diverifikasi' => [],
            'pengajuan_direvisi' => [],
        ];

        foreach ($tanggalLabels as $label) {
            $bulan = substr($label, 0, 7);

            $datasets['total_pengajuan'][] = $data->where('bulan', $bulan)->sum('total');
            $datasets['proses_verifikasi'][] = $data->where('bulan', $bulan)->where('status', 2)->sum('total');
            $datasets['telah_diverifikasi'][] = $data->where('bulan', $bulan)->where('status', 3)->sum('total');
            $datasets['pengajuan_direvisi'][] = $data->where('bulan', $bulan)->where('status', 4)->sum('total');
        }

        // Untuk kotak statistik
        $total_pengajuan = DB::table('skpi')->count();
        $proses_verifikasi = DB::table('skpi')->where('status', 2)->count();
        $telah_diverifikasi = DB::table('skpi')->where('status', 3)->count();
        $pengajuan_direvisi = DB::table('skpi')->where('status', 4)->count();

        // Kirim data ke view
        return view('baak.dashboardBaak', compact(
            'datasets',
            'tanggalLabels',
            'total_pengajuan',
            'proses_verifikasi',
            'telah_diverifikasi',
            'pengajuan_direvisi'
        ));
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
