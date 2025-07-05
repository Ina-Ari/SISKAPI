<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Models\Kegiatan;

class AuthAdminController extends Controller
{
    function login()
    {
        return view('login');
    }

    function indexAdmin()
    {
        $jumlahKegiatan = Kegiatan::count();
        $terverifikasi = Kegiatan::where('verif', 'true')->count();
        $belumterverifikasi = Kegiatan::where('verif', 'false')->count();
        $jumlahMahasiswa = Mahasiswa::has('kegiatan')->count();

        // Hitung total kegiatan yang diajukan oleh mahasiswa
        $totalMhs = DB::table('mahasiswa')->count();

        $totalVerifTrue = DB::table('kegiatan')
        ->where('verif', 'true')
        ->count();

        $totalVerifFalse = DB::table('kegiatan')
        ->where('verif', 'false')
        ->count();

        return view('dashboard', compact('jumlahKegiatan','terverifikasi','belumterverifikasi','jumlahMahasiswa',
                                        'totalMhs', 'totalVerifTrue', 'totalVerifFalse'));
    }

    function daftarKegiatan()
    {
        return view('daftarkegiatan');
    }

    function loggedin(Request $request)
    {
        // Membuat key unik untuk pembatasan login berdasarkan username dan IP
        $key = Str::lower($request->input('username')) . '|' . $request->ip();

        // Mengecek apakah ada terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $remainingTime = RateLimiter::availableIn($key); // Waktu tunggu sebelum mencoba login lagi
            return redirect()->back()->with('gagal', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $remainingTime . ' detik.');
        }

        // Ambil data pengguna berdasarkan username
        $user = \App\Models\AuthAdmin::where('username', $request->input('username'))->first();

        // Periksa apakah pengguna ada dan password cocok
        if ($user && ($user->password === $request->input('password') || Hash::check($request->input('password'), $user->password))) {
            // Jika password masih plaintext, hash dan simpan ke database
            if ($user->password === $request->input('password')) {
                $user->password = Hash::make($request->input('password')); // Hash password plaintext
                $user->save(); // Simpan perubahan ke database
            }

            // Login pengguna menggunakan guard admin
            Auth::guard('admin')->login($user);

            // Reset percobaan login di RateLimiter
            RateLimiter::clear($key);

            // Regenerasi sesi untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman dashboard admin
            return redirect()->route('indexAdmin');

        } else {
            // Jika login gagal, tambahkan hit ke RateLimiter
            RateLimiter::hit($key, 60); // Tambah percobaan, reset setelah 60 detik
            return redirect()->back()->with('gagal', 'Username atau password anda salah');
        }
    }

    public function logout(Request $request)
    {
        // Log out the authenticated user
        Auth::guard('admin')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
