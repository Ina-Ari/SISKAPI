<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthMhsController;
use App\Http\Controllers\jenisKegiatanController;
use App\Http\Controllers\SkpiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tingkatKegiatanController;
use App\Http\Controllers\posisiController;
use App\Http\Controllers\poinController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\BaakController;
use App\Http\Controllers\NotificationMhs;
use App\Http\Controllers\UpapkkController;
use Illuminate\Notifications\Notification;
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
    Route::redirect('/', '/login');

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
            // Notifikasi
            Route::get('/notifikasiMhs', [AuthMhsController::class, 'notifikasiMhs'])->name('notifikasiMhs');
            Route::get('/mahasiswa/notifikasi', [NotificationMhs::class, 'lihatMahasiswa'])->name('pagenotif');
        });
    });

    // Kepala Prodi
    Route::middleware('role:kaprodi')->name('kaprodi.')->group(function() {
        Route::controller(KaprodiController::class)->group(function() {
            Route::get('/kaprodi/dashboard', 'index')->name('dashboard');
            Route::get('/kaprodi/form', 'formKaprodi')->name('form');
            Route::post('/kaprodi/tambahDataSkpi1', 'storeSkpi1')->name('storeSkpi1');
            Route::post('/kaprodi/tambahDataSkpi2', 'storeSkpi2')->name('storeSkpi2');
            Route::get('/kaprodi/notifikasi', 'notifKaprodi')->name('notifikasi');
        });
 
        Route::controller(SkpiController::class)->name('skpi.')->group(function() {
            Route::get('/kaprodi/skpi-mahasiswa', 'showSkpiMahasiswaKaprodiView')->name('mahasiswa');
            Route::post('/kaprodi/skpi-mahasiswa/template', 'createTemplate')->name('create.template');
            Route::post('/kaprodi/skpi-mahasiswa/create', 'create')->name('create');
        });
    });

    // BAAK
    Route::middleware('role:baak')->name('baak.')->group(function() {
        Route::controller(BaakController::class)->group(function() {
            Route::get('/baak/dashboard', 'index')->name('dashboard');
            Route::get('/baak/notifikasi', 'comments')->name('notifikasi');
        });

        Route::controller(SkpiController::class)->name('skpi.')->group(function() {
            Route::get('/baak/skpi-mahasiswa', 'showSkpiMahasiswaBaakView')->name('mahasiswa');
            Route::put('/baak/skpi-mahasiswa/verification', 'verification')->name('verification');
            Route::put('/baak/skpi-mahasiswa/revision', 'revision')->name('revision');
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
            Route::post('/upapkk/unverif-selected', [UpapkkController::class, 'cancelSelected'])->name('upapkk.unverifSelected');
            Route::post('/upapkk/notifikasi/kirim', [NotificationMhs::class, 'sendComment'])->name('kirimnotif');
            Route::get('/upapkk/notifikasi', 'comments')->name('notifikasi');
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

?>
