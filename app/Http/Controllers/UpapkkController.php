<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kegiatan;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\User;
use App\Notifications\NotifikasiMhs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpapkkController extends Controller
{

    public function index()
    {
        $jumlahKegiatan = Kegiatan::count();
        $terverifikasi = Kegiatan::where('status', 'true')->count();
        $belumterverifikasi = Kegiatan::where('status', 'false')->count();
        $jumlahMahasiswa = Mahasiswa::whereHas('kegiatan')->count();
        $upapkk = Auth::user();

        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('dashboard', compact('jumlahKegiatan', 'terverifikasi', 'belumterverifikasi', 'jumlahMahasiswa', 'jumlahNotif'));
    }

    public function daftarMhs(Request $request)
    {
        $jurusan = Jurusan::all();

        // Query mahasiswa dengan eager load prodi.jurusan, kegiatan.poin, dan user
        $query = Mahasiswa::with(['prodi.jurusan', 'kegiatan.poin', 'user']);

        // Filter berdasarkan jurusan jika dipilih
        if ($request->has('jurusan') && $request->jurusan != 'all') {
            $query->whereHas('prodi', function ($q) use ($request) {
                $q->where('kode_jurusan', $request->jurusan);
            });
        }

        // Ambil mahasiswa yang memiliki kegiatan
        $data = $query->whereHas('kegiatan')->get();

        // Hitung status kelulusan berdasarkan total poin
        $status = [];
        foreach ($data as $mahasiswa) {
            $totalPoin = 0;

            foreach ($mahasiswa->kegiatan as $kegiatan) {
                if ($kegiatan->status === 'true') {
                    $totalPoin += $kegiatan->poin->poin;
                }
            }

            $keterangan = $totalPoin >= 28 ? 'Lulus' : 'Belum Lulus';

            $status[$mahasiswa->nim] = [
                'keterangan' => $keterangan,
                'totalPoin' => $totalPoin,
            ];
        }

        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('daftarmahasiswa', compact('data', 'status', 'jurusan', 'jumlahNotif'));
    }

    public function kegiatanMhs($id, Request $request)
    {
        $filter = $request->get('filter', 'all');

        // Ambil data mahasiswa beserta kegiatan yang difilter
        $query = Mahasiswa::with([
            'kegiatan' => function ($q) use ($filter) {
                if ($filter === 'true') {
                    $q->where('status', 'true');
                } elseif ($filter === 'false') {
                    $q->where('status', 'false');
                }
            },
        ])->findOrFail($id);

        // dd($query);
        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('kegiatanmahasiswa', compact('query', 'jumlahNotif'))->with('filter', $filter);
    }

    public function kegiatanVerif()
    {
        $kegiatan = Kegiatan::with(['poin.posisi', 'poin.tingkatKegiatan', 'poin.jenisKegiatan'])
            ->where('status', 'true')
            ->get();
        // dd($kegiatan);

        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        return view('kegiatan', compact('kegiatan', 'jumlahNotif'));
    }

    public function notVerified()
    { 
        $kegiatan = Kegiatan::with(['poin.posisi', 'poin.tingkatKegiatan', 'poin.jenisKegiatan'])
            ->where('status', '!=', 'true')
            ->get();

        $upapkk = Auth::user();
        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();
            
        return view('kegiatan_not_verified', compact('kegiatan', 'jumlahNotif'));
    }

    public function verifySelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id', $ids)->update(['status' => 'true', 'status_sertif' => 'true']);

        return redirect()->route('upapkk.unverifKegiatan')->with('success', 'Kegiatan berhasil diverifikasi.');
    }

    public function cancelSelected(Request $request)
    {
        $ids = $request->input('selected_kegiatan', []);
        Kegiatan::whereIn('id', $ids)->update(['status' => 'false']);

        return redirect()->route('upapkk.verifKegiatan')->with('success', 'Verfikasi kegiatan berhasil dibatalkan.');
    }

    public function comments()
    {
        $upapkk = Auth::user();

        if (!$upapkk) {
            abort(403, 'Anda tidak terautentikasi');
        }

        // Hitung jumlah notifikasi belum dibaca
        $jumlahNotif = $upapkk->unreadNotifications->count();

        $notifikasi = DB::table('notifications')
            ->where('type', 'App\Notifications\NotifikasiMhs')
            ->whereJsonContains('data->admin_id', $upapkk->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifikasiupapkk', compact('notifikasi', 'jumlahNotif'));
    }

}
