<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TingkatKegiatan;
use Illuminate\Support\Facades\Auth;

class tingkatKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TingkatKegiatan::all();
        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();
        
        return view('tingkat_kegiatan', compact('data', 'jumlahNotif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tingkat_kegiatan' => 'required|string|max:45',
        ]);

        TingkatKegiatan::create($request->all());
        return redirect()->back()->with('success', 'Tingkat kegiatan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'tingkat_kegiatan' => 'required|string|max:45',
        ]);

        // Mencari tingkat kegiatan berdasarkan ID
        $tingkatKegiatan = TingkatKegiatan::findOrFail($id);

        // Mengupdate data
        $tingkatKegiatan->update($request->all());

        // Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'tingkat kegiatan berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /// Mencari data berdasarkan ID
        $tingkatKegiatan = TingkatKegiatan::find($id);

        if ($tingkatKegiatan) {
            // Menghapus data
            $tingkatKegiatan->delete();
            return redirect()->route('upapkk.tingkatKegiatan');
        } 
    }
}
