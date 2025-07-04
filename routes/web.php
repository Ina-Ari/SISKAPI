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
use App\Http\Controllers\BaakController;
use App\Http\Controllers\UpapkkController;
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
});


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
    Route::middleware('role:mahasiswa')->name('mahasiswa.')->group(function() {
        Route::controller(MahasiswaController::class)->group(function() {
            Route::get('/mahasiswa/dashboard', 'index')->name('dashboard');
            Route::post('/mahasiswa/tambahKegiatan', 'store')->name('storeKegiatan');
            Route::post('/mahasiswa/{id}/editKegiatan', 'update')->name('updateKegiatan');
            Route::delete('/mahasisw/{id}/hapusKegiatan', 'destroy')->name('destroyKegiatan');
            Route::get('/mahasiswa/profile', 'profile')->name('profile');
            Route::post('/mahasiswa/{id}/editProfile', 'updateProfile')->name('updateProfile');
        });
    });

    // Kepala Prodi
    Route::middleware('role:kaprodi')->name('kaprodi.')->group(function() {
        Route::controller(KaprodiController::class)->group(function() {
            Route::get('/kaprodi/dashboard', 'index')->name('dashboard');
            Route::get('/kaprodi/form', 'formKaprodi')->name('form');
            Route::post('/kaprodi/tambahDataSkpi1', 'storeSkpi1')->name('storeSkpi1');
            Route::post('/kaprodi/tambahDataSkpi2', 'storeSkpi2')->name('storeSkpi2');
        });
    });

    // BAAK
    Route::middleware('role:baak')->name('baak.')->group(function() {
        Route::controller(BaakController::class)->group(function() {
            Route::get('/baak/dashboard', 'index')->name('dashboard');
        });
    });

    // UPAPKK
    Route::middleware('role:upapkk')->name('upapkk.')->group(function() {
        Route::controller(UpapkkController::class)->group(function() {
            Route::get('/upapkk/dashboard', 'index')->name('dashboard');
            Route::get('/upapkk/daftarMahasiswa', 'daftarMhs')->name('daftarMhs');
            Route::get('/upapkk/{id}/daftarKegiatan', 'kegiatanMhs')->name('daftarKegiatan');
            Route::get('/upapkk/verifKegiatan', 'kegiatanVerif')->name('verifKegiatan');
            Route::get('/upapkk/unverifKegiatan', 'notVerified')->name('unverifKegiatan');
            Route::post('/upapkk/verifSelected', 'verifySelected')->name('verifSelected');
            Route::post('/upapkk/unverifSelected', 'cancelSelected')->name('unverifSelected');
        });
        Route::controller(jenisKegiatanController::class)->group(function() {
            Route::get('/upapkk/jenisKegiatan', 'index')->name('jenisKegiatan');
            Route::post('/upapkk/tambahJenisKegiatan', 'store')->name('storeJenisKegiatan');
            Route::put('/upapkk/{id}/editJenisKegiatan', 'update')->name('updateJenisKegiatan');
            Route::delete('/upapkk/{id}/hapusJenisKegiatan', 'destroy')->name('destroyJenisKegiatan');
        });
        Route::controller(tingkatKegiatanController::class)->group(function() {
            Route::get('/upapkk/tingkatKegiatan', 'index')->name('tingkatKegiatan');
            Route::post('/upapkk/tambahTingkatKegiatan', 'store')->name('storeTingkatKegiatan');
            Route::put('/upapkk/{id}/editTingkatKegiatan', 'update')->name('updateTingkatKegiatan');
            Route::delete('/upapkk/{id}/hapusTingkatKegiatan', 'destroy')->name('destroyTingkatKegiatan');
        });
        Route::controller(posisiController::class)->group(function() {
            Route::get('/upapkk/posisi', 'index')->name('posisi');
            Route::post('/upapkk/tambahPosisi', 'store')->name('storePosisi');
            Route::put('/upapkk/{id}/editPosisi', 'update')->name('updatePosisi');
            Route::delete('/upapkk/{id}/hapusPosisi', 'destroy')->name('destroyPosisi');
        });
        Route::controller(poinController::class)->group(function() {
            Route::get('/upapkk/poin', 'index')->name('poin');
            Route::post('/upapkk/tambahPoin', 'store')->name('storePoin');
            Route::put('/upapkk/{id}/editPoin', 'update')->name('updatePoin');
            Route::delete('/upapkk/{id}/hapusPoin', 'destroy')->name('destroyPoin');
        });
    });
});


// // Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
// Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
// Route::get('kegiatan/not-verified', [KegiatanController::class, 'notVerified'])->name('kegiatan_not_verified');
// Route::post('kegiatan/verify-selected', [KegiatanController::class, 'verifySelected'])->name('kegiatan.verify_selected');
// Route::post('kegiatan/cancel-selected', [KegiatanController::class, 'cancelSelected'])->name('kegiatan.cancel_selected');

// //Routing Pages
// // Route::get('/', [dashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
// Route::resource('posisi', posisiController::class);


// //routing kegiatan
// Route::resource('tingkatKegiatan', tingkatKegiatanController::class);
// Route::resource('posisi', posisiController::class);

// Route::resource('form', formControl::class);
// Route::get('/dashboardMhs', [formControl::class,'indexMahasiswa'])->name('dashboardMhs');
// Route::get('/form', function () {
//     return view('form');
// });
// Route::post('/tambahKegiatan', [formControl::class, 'store'])->name('form.store');
// Route::post('/updateKegiatan/{id_kegiatan}', [formControl::class, 'updateKegiatan'])->name('form.updateKegiatan');
// Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
// Route::get('/mahasiswa/{id}/kegiatan', [MahasiswaController::class, 'kegiatan'])->name('mahasiswa.kegiatan');

// Route::delete('/deletekegiatan/{id}', [formControl::class, 'destroy'])->name('kegiatan.destroy');

// Route::get('/mahasiswa/{nim}/edit', [formControl::class, 'edit'])->name('form.edit');
// Route::post('/mahasiswa/{nim}/update', [formControl::class, 'update'])->name('form.update');


// // Route::resource('KaprodiController', KaprodiController::class);
// // Route::get('/formKaprodi', [KaprodiController::class, 'formKaprodi'])->name('formKaprodi');
// // Route::post('/tambahDataSkpi1', [KaprodiController::class, 'storeSkpi1'])->name('form.storeSkpi1');
// // Route::post('/tambahDataSkpi2', [KaprodiController::class, 'storeSkpi2'])->name('form.storeSkpi2');
?>
