<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posisi;
use Illuminate\Support\Facades\Auth;

class posisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Posisi::all();
        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('posisi', compact('data', 'jumlahNotif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_posisi' => 'required|string|max:45',
        ]);

        Posisi::create($request->all());
        return redirect()->back()->with('success', 'Posisi berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'nama_posisi' => 'required|string|max:45',
        ]);

        // Mencari jenis kegiatan berdasarkan ID
        $posisi = Posisi::findOrFail($id);

        // Mengupdate data
        $posisi->update($request->all());

        // Kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Posisi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /// Mencari data berdasarkan ID
        $posisi = Posisi::find($id);

        if ($posisi) {
            // Menghapus data
            $posisi->delete();
            return redirect()->route('posisi.index');
        }
    }
}
