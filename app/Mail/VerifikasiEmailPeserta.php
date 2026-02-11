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

class VerifikasiEmailPeserta extends Mailable
{
    use Queueable, SerializesModels;

    public $peserta;
    public $verificationUrl;
    private $idCardPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Peserta $peserta)
    {
        $this->peserta = $peserta;
        $this->verificationUrl = route('pendaftaran.verify', ['token' => $peserta->email_verification_token]);

        // Generate ID Card
        try {
            $idCardGenerator = new IdCardGenerator();
            $this->idCardPath = $idCardGenerator->generate($peserta);
        } catch (\Exception $e) {
            \Log::error('Error generating ID Card: ' . $e->getMessage());
            $this->idCardPath = null;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Verifikasi Email Pendaftaran JKPI 2026');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(view: 'emails.verifikasi-email');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->idCardPath && Storage::disk('public')->exists($this->idCardPath)) {
            try {
                $fullPath = Storage::disk('public')->path($this->idCardPath);

                $attachments[] = Attachment::fromPath($fullPath)->as('ID-Card-JKPI-2026.pdf')->withMime('application/pdf');
            } catch (\Exception $e) {
                \Log::error('Error attaching ID Card: ' . $e->getMessage());
            }
        }

        return $attachments;
    }
}
