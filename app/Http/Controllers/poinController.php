<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;
use Illuminate\Support\Facades\Auth;

class poinController extends Controller{

    public function index()
    {
        $data = Poin::with(['posisi', 'tingkatKegiatan', 'jenisKegiatan' ])->get();
        $posisi = Posisi::all();
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('poin', compact('data', 'posisi', 'tingkatKegiatan', 'jenisKegiatan', 'jumlahNotif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idjenis_kegiatan'  => 'required',
            'idtingkat_kegiatan'=> 'required',
            'id_posisi'         => 'required',
            'poin'              => 'required|integer',
        ]);

        Poin::create($request->all());

        return redirect()->back()->with('success', 'Data poin berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'idjenis_kegiatan'  => 'required',
            'idtingkat_kegiatan'=> 'required',
            'id_posisi'         => 'required',
            'poin'              => 'required|integer',
        ]);

        $poin = Poin::findOrFail($id);

        $poin->update($request->all());

        return redirect()->back()->with('success', 'Data poin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poin = Poin::find($id);

        if ($poin) {
            // Menghapus data
            $poin->delete();
            return redirect()->route('poin.index');
        }
    }
}
