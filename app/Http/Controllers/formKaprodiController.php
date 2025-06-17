<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\FormKaprodi;

class formKaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::where('kode_jurusan', 40)->get();
        // dd($prodi);
        return view('kaprodi.formKaprodi', compact('prodi'));
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
    public function storeSkpi1(Request $request)
    {
        $request->validate([
            'gelar'  => 'required',
        ]);

        FormKaprodi::create($request->all());

        return redirect()->back()->with('success', 'Data form berhasil ditambahkan!');
    }

    // public function storeSkpi2(Request $request)
    // {
    //     $sikapList = $request->input('sikap');
    //     $attitudeList = $request->input('attitude');

    //     foreach ($sikapList as $index => $sikap) {
    //         // Simpan jika tidak kosong dua-duanya
    //         if (!empty($sikap) || !empty($attitudeList[$index])) {
    //             Sikap::create([
    //                 'sikap' => $sikap,
    //                 'attitude' => $attitudeList[$index],
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Data berhasil disimpan.');

    //     // FormKaprodi::create($request->all());

    //     // return redirect()->back()->with('success', 'Data form berhasil ditambahkan!');
    // }

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
