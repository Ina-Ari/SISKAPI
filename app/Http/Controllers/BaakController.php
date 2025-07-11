<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hitung statistik kotak
        $total_pengajuan = DB::table('skpi')
            ->whereIn('status', [1, 3, 4])
            ->count();

        $belum_diverifikasi = DB::table('skpi')
            ->where('status', 1)
            ->count();

        $telah_diverifikasi = DB::table('skpi')
            ->where('status', 3)
            ->count();

        $pengajuan_ditolak = DB::table('skpi')
            ->where('status', 4)
            ->count();

        // Ambil data grafik per bulan
        $grafikRaw = DB::table('skpi')
            ->select(DB::raw('DATE_FORMAT(updated_at, "%Y-%m") as bulan'), 'status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', [1, 3, 4])
            ->groupBy('bulan', 'status')
            ->orderBy('bulan')
            ->get();

        // Buat list bulan dari Jan 2025 sampai Juli 2025 (atau sekarang)
        $start = Carbon::parse('2025-01-01');
        $end = Carbon::now()->startOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $tanggalLabels = [];
        $dataByBulan = [];

        // Inisialisasi semua bulan dengan 0
        foreach ($period as $date) {
            $label = $date->translatedFormat("M 'y");
            $tanggalLabels[] = $label;
            $dataByBulan[$label] = [
                1 => 0,
                3 => 0,
                4 => 0,
            ];
        }

        // Isi data berdasarkan hasil query
        foreach ($grafikRaw as $row) {
            $labelBulan = Carbon::parse($row->bulan)->translatedFormat("M 'y");
            if (isset($dataByBulan[$labelBulan])) {
                $dataByBulan[$labelBulan][$row->status] = $row->total;
            }
        }

        // Susun dataset untuk grafik
        $datasets = [
            'total_pengajuan' => [],
            'belum_diverifikasi' => [],
            'telah_diverifikasi' => [],
            'pengajuan_ditolak' => [],
        ];

        foreach ($tanggalLabels as $label) {
            $datasets['total_pengajuan'][] =
                $dataByBulan[$label][1] +
                $dataByBulan[$label][3] +
                $dataByBulan[$label][4];

            $datasets['belum_diverifikasi'][] = $dataByBulan[$label][1];
            $datasets['telah_diverifikasi'][] = $dataByBulan[$label][3];
            $datasets['pengajuan_ditolak'][] = $dataByBulan[$label][4];
        }

        return view('baak.dashboardBAAK', [
            'total_pengajuan' => $total_pengajuan,
            'belum_diverifikasi' => $belum_diverifikasi,
            'telah_diverifikasi' => $telah_diverifikasi,
            'pengajuan_ditolak' => $pengajuan_ditolak,
            'tanggalLabels' => $tanggalLabels,
            'datasets' => $datasets,
        ]);
    }
}
