<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hotel', function () {
    return view('hotel');
});

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

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::redirect('/dashboard', '/admin/dashboard')->name('dashboard');
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Export Routes (HARUS DI ATAS route {id} agar tidak conflict)
        Route::get('/dashboard/export/all', [DashboardController::class, 'exportAll'])->name('dashboard.export.all');
        Route::get('/dashboard/export/verified', [DashboardController::class, 'exportVerified'])->name('dashboard.export.verified');
        Route::get('/dashboard/export/unverified', [DashboardController::class, 'exportUnverified'])->name('dashboard.export.unverified');
        Route::get('/dashboard/export/cancelled', [DashboardController::class, 'exportCancelled'])->name('dashboard.export.cancelled');
        Route::get('/dashboard/export/statistik', [DashboardController::class, 'exportStatistik'])->name('dashboard.export.statistik');
        Route::get('/dashboard/export/by-provinsi', [DashboardController::class, 'exportByProvinsi'])->name('dashboard.export.by-provinsi');

        // CRUD Routes (HARUS DI BAWAH route export)
        Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
        Route::patch('/dashboard/{id}/status', [DashboardController::class, 'updateStatus'])->name('dashboard.update-status');
        Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    });

require __DIR__ . '/auth.php';
