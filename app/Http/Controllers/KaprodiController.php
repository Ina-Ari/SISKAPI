<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\FormKaprodi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KaprodiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Status count total untuk kotak status
        $statusCounts = DB::table('skpi')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Ambil data grafik: group by tanggal dan status
        $grafikDataRaw = DB::table('skpi')
            ->select(DB::raw('DATE(updated_at) as tanggal'), 'status', DB::raw('count(*) as jumlah'))
            ->groupBy('tanggal', 'status')
            ->orderBy('tanggal')
            ->get();

        // Format data jadi per tanggal dengan masing-masing status (1-5)
        $dataByTanggal = [];
        foreach ($grafikDataRaw as $row) {
            $dataByTanggal[$row->tanggal][$row->status] = $row->jumlah;
        }

        // Ambil semua tanggal yang unik
        $tanggalLabels = array_keys($dataByTanggal);

        // Siapkan dataset status 1-5, isian default 0
        $datasets = [];
        for ($status = 1; $status <= 5; $status++) {
            $datasets[$status] = [];
            foreach ($tanggalLabels as $tanggal) {
                $datasets[$status][] = $dataByTanggal[$tanggal][$status] ?? 0;
            }
        }

        // Data untuk tampilan tanggal sekarang
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->translatedFormat('F Y');
        $dayName = $now->translatedFormat('l');
        $dayNumber = $now->translatedFormat('d');

        return view('kaprodi.dashboardKaprodi', [
            'statusCounts' => $statusCounts,
            'tanggalLabels' => $tanggalLabels,
            'grafikDataset' => $datasets,
            'today' => $today,
            'dayName' => $dayName,
            'dayNumber' => $dayNumber
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formKaprodi()
    {
        $prodi = Prodi::where('kode_jurusan', 40)->get();
        // dd($prodi);
        return view('kaprodi.formKaprodi', compact('prodi'));
    }

    public function storeSkpi1(Request $request)
    {
        $request->validate([
            'gelar'  => 'required',
        ]);

        FormKaprodi::create($request->all());

        return redirect()->back()->with('success', 'Data form berhasil ditambahkan!');
    }

    public function storeSkpi2(Request $request)
    {
        // Validasi umum
        $request->validate([
            'sikap.*' => 'required|string',
            'attitude.*' => 'required|string',
            'penguasaan_pengetahuan.*' => 'required|string',
            'knowledge.*' => 'required|string',
            'keterampilan_umum.*' => 'required|string',
            'general_skills.*' => 'required|string',
            'keterampilan_khusus.*' => 'required|string',
            'special_skills.*' => 'required|string',
        ]);

        FormKaprodi::create([
            'sikap' => implode('; ', $request->sikap),
            'attitude' => implode('; ', $request->attitude),
            'penguasaan_pengetahuan' => implode('; ', $request->penguasaan_pengetahuan),
            'knowledge' => implode('; ', $request->knowledge),
            'keterampilan_umum' => implode('; ', $request->keterampilan_umum),
            'general_skills' => implode('; ', $request->general_skills),
            'keterampilan_khusus' => implode('; ', $request->keterampilan_khusus),
            'special_skills' => implode('; ', $request->special_skills),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan ke satu baris!');
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
