<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kegiatan;
use App\Models\Role;
use App\Models\User; // The central User model
use App\Notifications\NotifikasiMhs;
use Illuminate\Support\Facades\Log;

class NotificationMhs extends Controller
{
    public function sendComment(Request $request)
    {
        Log::info('Incoming sendComment request:', $request->all());

        $request->validate([
            'mahasiswa_id'  => 'required|exists:users,id',
            'komentar'      => 'required|string',
            'id_kegiatan'   => 'required|exists:kegiatan,id',
        ]);

        $admin = Auth::user(); // Gunakan huruf kecil `user()` sesuai standar Laravel
        if (!$admin) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda tidak terautentikasi.',
            ], 401);
        }

        $komentar = $request->komentar;
        $idKegiatan = $request->id_kegiatan;
        $kegiatan = Kegiatan::find($idKegiatan);

        if (!$kegiatan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Kegiatan tidak ditemukan.',
            ], 404);
        }

        $namaKegiatan = $kegiatan->nama_kegiatan;

        // Ambil tanggal kegiatan — sesuaikan nama kolom jika berbeda
        $tanggalKegiatan = $kegiatan->tanggal_kegiatan ?? $kegiatan->tanggal_pengajuan ?? null;

        if (!$tanggalKegiatan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Tanggal kegiatan tidak ditemukan.',
            ], 422);
        }

        // Format tanggal menjadi string yang bisa dibaca
        $tanggalFormatted = \Carbon\Carbon::parse($tanggalKegiatan)->format('d M Y');

        // Ambil mahasiswa berdasarkan user_id
        $mahasiswa = User::find($request->mahasiswa_id);

        if (!$mahasiswa) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Mahasiswa tidak ditemukan.',
            ], 404);
        }

        // Kirim notifikasi dengan tanggal kegiatan
        $mahasiswa->notify(new NotifikasiMhs(
            $komentar,
            $admin,
            $namaKegiatan,
            $tanggalFormatted
        ));

        Log::info("Notification sent to User ID: {$mahasiswa->id} for activity '{$namaKegiatan}' on date '{$tanggalFormatted}'.");

        return response()->json([
            'status'  => 'success',
            'message' => 'Notifikasi berhasil dikirim ke mahasiswa (DB + Email).',
        ]);
    }


    public function lihatMahasiswa()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->nama !== 'Mahasiswa') {
            abort(403, 'Akses hanya untuk mahasiswa');
        }

        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $user->unreadNotifications->count();

        // Ambil semua notifikasi
        $notifikasi = $user->notifications()->latest()->get();

        // Tandai semua sebagai sudah dibaca
        $user->unreadNotifications->markAsRead();

        // Kirim ke view
        return view('mhs.notifikasiMhs', compact('notifikasi', 'user', 'jumlahNotif'));
    }


}