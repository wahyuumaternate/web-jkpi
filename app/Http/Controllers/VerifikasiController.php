<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Mail\EmailVerifikasiSukses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifikasiController extends Controller
{
    public function verify($token)
    {
        try {
            $peserta = Peserta::where('email_verification_token', $token)->where('status', 'unverified')->first();

            if (!$peserta) {
                return view('pendaftaran.verification-failed', [
                    'message' => 'Link verifikasi tidak valid atau sudah kadaluarsa.',
                ]);
            }

            // Update status peserta
            $peserta->markEmailAsVerified();

            // Kirim email verifikasi sukses dengan ID Card
            try {
                Mail::to($peserta->email)->send(new EmailVerifikasiSukses($peserta));

                \Log::info('Verification success email sent with ID Card', [
                    'peserta' => $peserta->kode_registrasi,
                    'email' => $peserta->email,
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to send verification success email', [
                    'peserta' => $peserta->kode_registrasi,
                    'error' => $e->getMessage(),
                ]);
                // Jangan throw error, biarkan verifikasi tetap berhasil
            }

            return view('pendaftaran.verification-success', [
                'peserta' => $peserta,
            ]);
        } catch (\Exception $e) {
            \Log::error('Verification error', [
                'token' => $token,
                'error' => $e->getMessage(),
            ]);

            return view('pendaftaran.verification-failed', [
                'message' => 'Terjadi kesalahan saat verifikasi. Silakan hubungi panitia.',
            ]);
        }
    }
}
