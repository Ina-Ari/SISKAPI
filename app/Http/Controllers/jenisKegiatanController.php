<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKegiatan;

class jenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $data = JenisKegiatan::all();
        return view('jenis_kegiatan', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kegiatan' => 'required|string|max:45',
            'kategori_skpi' => 'required|in:organisasi,aktivitas,pelatihan,kerja',
        ]);

        JenisKegiatan::create($request->all());
        return redirect()->back()->with('success', 'Jenis kegiatan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'jenis_kegiatan' => 'required|string|max:45',
            'kategori_skpi' => 'required|in:organisasi,aktivitas,pelatihan,kerja',
        ]);

        // Mencari jenis kegiatan berdasarkan ID
        $jenisKegiatan = JenisKegiatan::findOrFail($id);

        // Mengupdate data
        $jenisKegiatan->update($request->all());

        // Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jenis kegiatan berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /// Mencari data berdasarkan ID
        $jenisKegiatan = JenisKegiatan::find($id);

        if ($jenisKegiatan) {
            // Menghapus data
            $jenisKegiatan->delete();
            return redirect()->route('upapkk.jenisKegiatan');
        }
    }
}
