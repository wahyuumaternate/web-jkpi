<?php

namespace App\Mail;

use App\Models\Peserta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiEmailPeserta extends Mailable
{
    use Queueable, SerializesModels;

    public $peserta;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Peserta $peserta)
    {
        $this->peserta = $peserta;
        $this->verificationUrl = route('pendaftaran.verify', ['token' => $peserta->email_verification_token]);
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
        return [];
    }
}
