<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
|--------------------------------------------------------------------------
| Web Routes - Pendaftaran Peserta
|--------------------------------------------------------------------------
*/

Route::prefix('registrasi')
    ->name('pendaftaran.')
    ->group(function () {
        // Form pendaftaran
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');

        // Proses pendaftaran
        Route::post('/', [PendaftaranController::class, 'store'])->name('store');

        // Halaman sukses
        Route::get('/success', [PendaftaranController::class, 'success'])->name('success');

        // Verifikasi email
        Route::get('/verify/{token}', [PendaftaranController::class, 'verify'])->name('verify');

        // Kirim ulang email verifikasi
        Route::post('/resend-verification', [PendaftaranController::class, 'resendVerification'])->name('resend');

        // Cek status pendaftaran
        Route::post('/check-status', [PendaftaranController::class, 'checkStatus'])->name('check-status');
        Route::get('/status', function () {
            return view('pendaftaran.check-status');
        })->name('check-status-form');
    });

require __DIR__ . '/auth.php';
