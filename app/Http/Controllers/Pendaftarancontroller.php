<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Http\Requests\PendaftaranPesertaRequest;
use App\Mail\VerifikasiEmailPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan halaman form pendaftaran
     */
    public function index()
    {
        return view('pendaftaran.index');
    }

    /**
     * Proses pendaftaran peserta
     */
    public function store(PendaftaranPesertaRequest $request)
    {
        try {
            $data = $request->validated();

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('peserta/foto', 'public');
            }

            // Buat peserta baru
            $peserta = Peserta::create($data);

            // Kirim email verifikasi
            Mail::to($peserta->email)->send(new VerifikasiEmailPeserta($peserta));

            return redirect()
                ->route('pendaftaran.success')
                ->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.')
                ->with('kode_registrasi', $peserta->kode_registrasi);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database errors (unique constraint, etc)
            \Log::error('Database error saat pendaftaran: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan database. Email mungkin sudah terdaftar.');
        } catch (\Exception $e) {
            // Handle other errors
            \Log::error('Error saat pendaftaran: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman sukses pendaftaran
     */
    public function success()
    {
        if (!session()->has('kode_registrasi')) {
            return redirect()->route('pendaftaran.index');
        }

        return view('pendaftaran.success');
    }

    /**
     * Verifikasi email peserta
     */
    public function verify(Request $request, $token)
    {
        // Cari peserta berdasarkan token
        $peserta = Peserta::where('email_verification_token', $token)
            ->whereNull('email_verified_at')
            ->first();

        // Token tidak ditemukan atau sudah digunakan
        if (!$peserta) {
            // Cek apakah token ada tapi sudah terverifikasi
            $verifiedPeserta = Peserta::where('email_verification_token', $token)
                ->whereNotNull('email_verified_at')
                ->first();

            if ($verifiedPeserta) {
                return redirect()
                    ->route('pendaftaran.index')
                    ->with('info', 'Email Anda sudah terverifikasi sebelumnya.');
            }

            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Token verifikasi tidak valid atau sudah kadaluarsa.');
        }

        // Verifikasi email
        $peserta->markEmailAsVerified();

        return view('pendaftaran.verified', compact('peserta'));
    }

    /**
     * Kirim ulang email verifikasi
     */
    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pendaftaran_peserta,email',
        ]);

        $peserta = Peserta::where('email', $request->email)->first();

        if ($peserta->hasVerifiedEmail()) {
            return back()->with('info', 'Email Anda sudah terverifikasi.');
        }

        // Kirim ulang email verifikasi
        Mail::to($peserta->email)->send(new VerifikasiEmailPeserta($peserta));

        return back()->with('success', 'Email verifikasi telah dikirim ulang.');
    }

    /**
     * Cek status pendaftaran
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'kode_registrasi' => 'required|string',
        ]);

        $peserta = Peserta::where('kode_registrasi', $request->kode_registrasi)->first();

        if (!$peserta) {
            return back()->with('error', 'Kode registrasi tidak ditemukan.');
        }

        return view('pendaftaran.status', compact('peserta'));
    }

    /**
     * Test verifikasi email (untuk debugging)
     */
    public function testVerifyForm()
    {
        return view('pendaftaran.test-verify');
    }

    /**
     * Proses test verifikasi
     */
    public function testVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pendaftaran_peserta,email',
        ]);

        $peserta = Peserta::where('email', $request->email)->first();

        return view('pendaftaran.test-verify', compact('peserta'));
    }
}