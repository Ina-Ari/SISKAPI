<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaakController extends Controller
{
    public function index()
    {
        // Hitung statistik kotak
        $total_pengajuan = DB::table('skpi')
            ->whereIn('status', ['Diajukan', 'Revisi', 'Selesai'])
            ->count();

        $diajukan = DB::table('skpi')
            ->where('status', 'Diajukan')
            ->count();

        $revisi = DB::table('skpi')
            ->where('status', 'Revisi')
            ->count();

        $selesai = DB::table('skpi')
            ->where('status', 'Selesai')
            ->count();

        // Ambil data grafik per bulan
        $grafikRaw = DB::table('skpi')
            ->select(DB::raw('DATE_FORMAT(updated_at, "%Y-%m") as bulan'), 'status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', ['Diajukan', 'Revisi', 'Selesai'])
            ->groupBy('bulan', 'status')
            ->orderBy('bulan')
            ->get();

        // Buat list bulan dari Jan 2025 sampai bulan ini
        $start = Carbon::parse('2025-01-01');
        $end = Carbon::now()->startOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $tanggalLabels = [];
        $dataByBulan = [];

        foreach ($period as $date) {
            $label = $date->translatedFormat("M 'y");
            $tanggalLabels[] = $label;
            $dataByBulan[$label] = [
                'Diajukan' => 0,
                'Revisi' => 0,
                'Selesai' => 0,
            ];
        }

        foreach ($grafikRaw as $row) {
            $labelBulan = Carbon::parse($row->bulan)->translatedFormat("M 'y");
            if (isset($dataByBulan[$labelBulan])) {
                $dataByBulan[$labelBulan][$row->status] = $row->total;
            }
        }

        $datasets = [
            'total_pengajuan' => [],
            'diajukan' => [],
            'revisi' => [],
            'selesai' => [],
        ];

        foreach ($tanggalLabels as $label) {
            $datasets['total_pengajuan'][] =
                $dataByBulan[$label]['Diajukan'] +
                $dataByBulan[$label]['Revisi'] +
                $dataByBulan[$label]['Selesai'];

            $datasets['diajukan'][] = $dataByBulan[$label]['Diajukan'];
            $datasets['revisi'][] = $dataByBulan[$label]['Revisi'];
            $datasets['selesai'][] = $dataByBulan[$label]['Selesai'];
        }

        return view('baak.dashboardBAAK', [
            'total_pengajuan' => $total_pengajuan,
            'diajukan' => $diajukan,
            'revisi' => $revisi,
            'selesai' => $selesai,
            'tanggalLabels' => $tanggalLabels,
            'datasets' => $datasets,
        ]);
    }
}
