<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hotel', function () {
    return view('hotel');
});

Route::get('/cafe-resto', function () {
    return view('cafe_resto');
});

Route::get('/toko-oleh-oleh', function () {
    return view('toko_oleh_oleh');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/buku-panduan', function () {
    return view('buku_panduan');
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
Route::get('/pendaftaran/verify/{token}', [VerifikasiController::class, 'verify'])->name('pendaftaran.verify');
require __DIR__ . '/auth.php';
Route::get('/test-pdf-preview', function () {
    // Load foto dan convert ke base64
    $fotoPath = public_path('assets/img/foto.png');
    $fotoBase64 = null;

    if (file_exists($fotoPath)) {
        $imageData = file_get_contents($fotoPath);
        $mimeType = mime_content_type($fotoPath);
        $fotoBase64 = "data:$mimeType;base64," . base64_encode($imageData);
    }

    $data = [
        'nama' => 'Dr. Ahmad Hidayat, M.Si',
        'instansi' => 'Pemerintah Kota Ternate',
        'status' => 'Kepala Dinas Kebudayaan',
        'kota' => 'Kota Ternate',
        'foto' => $fotoBase64, // Foto dalam base64
        'logo' => null, // Akan tampil text JKPI
        'qrCode' => base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(300)->errorCorrection('H')->margin(0)->generate('JKPI2026-ETT7UMLZ')),
        'nomor_id' => 'JKPI2026-ETT7UMLZ',
        'initial' => 'D',
    ];

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.id-card', $data)->setPaper([0, 0, 269.287, 357.1596], 'portrait');

    return $pdf->stream('preview-idcard.pdf');
});
