<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\jenisKegiatanController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('master');
// });

Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
// Route::get('/jenisKegiatan', [jenisKegiatanController::class, 'index'])->name('jenisKegiatan');

Route::resource('jenisKegiatan', jenisKegiatanController::class);

