<?php

namespace App\Mail;

use App\Models\Peserta;
use App\Services\IdCardGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class EmailVerifikasiSukses extends Mailable
{
    use Queueable, SerializesModels;

    public $peserta;
    private $idCardPath;
    private $generationError = null;

    /**
     * Create a new message instance.
     */
    public function __construct(Peserta $peserta)
    {
        $this->peserta = $peserta;

        // Generate ID Card setelah verifikasi sukses
        try {
            \Log::info('EmailVerifikasiSukses: Starting ID Card generation', [
                'peserta' => $peserta->kode_registrasi,
                'nama' => $peserta->nama_lengkap,
                'status' => $peserta->status,
            ]);

            $idCardGenerator = new IdCardGenerator();

            // Cek apakah ID Card sudah ada
            if ($idCardGenerator->exists($peserta)) {
                $this->idCardPath = $idCardGenerator->getPath($peserta);
                \Log::info('EmailVerifikasiSukses: Using existing ID Card', [
                    'peserta' => $peserta->kode_registrasi,
                    'path' => $this->idCardPath,
                ]);
            } else {
                // Generate baru - TIDAK PERLU skip verification karena peserta sudah verified
                \Log::info('EmailVerifikasiSukses: Generating new ID Card', [
                    'peserta' => $peserta->kode_registrasi,
                    'status' => $peserta->status,
                ]);

                $this->idCardPath = $idCardGenerator->generate($peserta, false); // false = cek verification

                \Log::info('EmailVerifikasiSukses: ID Card generated successfully', [
                    'peserta' => $peserta->kode_registrasi,
                    'path' => $this->idCardPath,
                    'exists' => Storage::disk('public')->exists($this->idCardPath),
                    'full_path' => Storage::disk('public')->path($this->idCardPath),
                ]);
            }

            // Double check file exists
            if (!$this->idCardPath || !Storage::disk('public')->exists($this->idCardPath)) {
                throw new \Exception('ID Card file not found after generation');
            }
        } catch (\Exception $e) {
            $this->generationError = $e->getMessage();

            \Log::error('EmailVerifikasiSukses: Error generating ID Card', [
                'peserta' => $peserta->kode_registrasi,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->idCardPath = null;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Selamat! Email Terverifikasi - ID Card Rakernas XII JKPI 2026');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verifikasi-sukses',
            with: [
                'peserta' => $this->peserta,
                'hasIdCard' => !is_null($this->idCardPath),
                'idCardError' => $this->generationError,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->idCardPath) {
            \Log::info('EmailVerifikasiSukses: Checking ID Card for attachment', [
                'peserta' => $this->peserta->kode_registrasi,
                'path' => $this->idCardPath,
                'storage_exists' => Storage::disk('public')->exists($this->idCardPath),
            ]);

            if (Storage::disk('public')->exists($this->idCardPath)) {
                try {
                    $fullPath = Storage::disk('public')->path($this->idCardPath);

                    \Log::info('EmailVerifikasiSukses: Full path info', [
                        'full_path' => $fullPath,
                        'file_exists' => file_exists($fullPath),
                        'is_readable' => is_readable($fullPath),
                        'file_size' => file_exists($fullPath) ? filesize($fullPath) : 0,
                    ]);

                    if (file_exists($fullPath) && is_readable($fullPath)) {
                        $attachments[] = Attachment::fromPath($fullPath)
                            ->as('ID-Card-JKPI-2026-' . $this->peserta->kode_registrasi . '.pdf')
                            ->withMime('application/pdf');

                        \Log::info('EmailVerifikasiSukses: ID Card attached to email', [
                            'peserta' => $this->peserta->kode_registrasi,
                            'file' => $fullPath,
                            'size' => filesize($fullPath),
                        ]);
                    } else {
                        \Log::warning('EmailVerifikasiSukses: File exists in storage but not readable', [
                            'peserta' => $this->peserta->kode_registrasi,
                            'path' => $fullPath,
                            'exists' => file_exists($fullPath),
                            'readable' => is_readable($fullPath),
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('EmailVerifikasiSukses: Error attaching ID Card', [
                        'peserta' => $this->peserta->kode_registrasi,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            } else {
                \Log::warning('EmailVerifikasiSukses: ID Card path set but file does not exist in storage', [
                    'peserta' => $this->peserta->kode_registrasi,
                    'path' => $this->idCardPath,
                    'full_path' => Storage::disk('public')->path($this->idCardPath),
                ]);
            }
        } else {
            \Log::warning('EmailVerifikasiSukses: ID Card path is null', [
                'peserta' => $this->peserta->kode_registrasi,
                'generation_error' => $this->generationError,
            ]);
        }

        return $attachments;
    }
}
