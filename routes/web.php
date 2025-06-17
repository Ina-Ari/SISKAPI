<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kegiatanController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthMhsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\tingkatKegiatanController;
use App\Http\Controllers\posisiController;
use App\Http\Controllers\poinController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\formControl;
use App\Http\Controllers\KaprodiController;
use Illuminate\Routing\Route as RoutingRoute;


/**
 * * GUEST ROUTES
 *
 * Daftar routing khusus untuk pengguna yang belum terautententikasi
 */
Route::middleware('guest')->group(function() {
    // Authentication
    Route::controller(AuthController::class)->group(function() {
        Route::get('/register', 'showRegistrationForm')->name('register.form');
        Route::post('/register', 'register')->name('register');

        Route::get('/account-setup', 'showAccountSetupForm')->name('account.setup.form');
        Route::post('/account-setup', 'accountSetup')->name('account.setup');

        Route::get('/login', 'showLoginForm')->name('login.form');
        Route::post('/login', 'login')->name('login');

        Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.forgot.form');
        Route::post('/forgot-password', 'forgotPassword')->name('password.forgot');

        Route::get('/reset-password', 'showResetPasswordForm')->name('password.forgot.form');
        Route::post('/reset-password', 'resetPassword')->name('password.reset');
    });
})->name('guest');


/**
 * * AUTH ROUTES
 *
 * Daftar routing untuk pengguna yang sudah terautentikasi
 */
Route::middleware('auth')->group(function() {
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /**
     * ! Jika ingin memfilter berdasarkan rolenya, bisa gunakan middleware role
     * * Role yang tersedia (mahasiswa, kaprodi, baak, upapkk)
     *
     * ? Contoh Penggunaan:
     * Route::middleware(role:mahasiswa)
     * Route::middleware(role:baak,upapkk)
     *
     * * Sangat direkomendasikan pakai group
     */


    // Mahasiswa
    Route::middleware('role:mahasiswa')->group(function() {
        Route::controller(MahasiswaController::class)->group(function() {
            Route::get('/mahasiswa/dashboard', 'index')->name('mahasiswa.dashboard');
        });
    })->name('mahasiswa');


    // Kepala Prodi

    // BAAK


    // UPAPKK
});


// Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('kegiatan/not-verified', [KegiatanController::class, 'notVerified'])->name('kegiatan_not_verified');
Route::post('kegiatan/verify-selected', [KegiatanController::class, 'verifySelected'])->name('kegiatan.verify_selected');
Route::post('kegiatan/cancel-selected', [KegiatanController::class, 'cancelSelected'])->name('kegiatan.cancel_selected');

//Routing Pages
// Route::get('/', [dashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);

//routing kegiatan
Route::resource('jenisKegiatan', jenisKegiatanController::class);
Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
Route::resource('posisi', posisiController::class);
Route::resource('poin', poinController::class);
Route::resource('form', formControl::class);
Route::get('/dashboardMhs', [formControl::class,'indexMahasiswa'])->name('dashboardMhs');
Route::get('/form', function () {
    return view('form');
});
Route::post('/tambahKegiatan', [formControl::class, 'store'])->name('form.store');
Route::post('/updateKegiatan/{id_kegiatan}', [formControl::class, 'updateKegiatan'])->name('form.updateKegiatan');
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/{id}/kegiatan', [MahasiswaController::class, 'kegiatan'])->name('mahasiswa.kegiatan');

Route::delete('/deletekegiatan/{id}', [formControl::class, 'destroy'])->name('kegiatan.destroy');

Route::get('/mahasiswa/{nim}/edit', [formControl::class, 'edit'])->name('form.edit');
Route::post('/mahasiswa/{nim}/update', [formControl::class, 'update'])->name('form.update');


Route::resource('KaprodiController', KaprodiController::class);
Route::get('/formKaprodi', [KaprodiController::class, 'formKaprodi'])->name('formKaprodi');
Route::post('/tambahDataSkpi1', [KaprodiController::class, 'storeSkpi1'])->name('form.storeSkpi1');
Route::post('/tambahDataSkpi2', [KaprodiController::class, 'storeSkpi2'])->name('form.storeSkpi2');
?>
