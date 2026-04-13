<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PsbVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $passwordPlain;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $passwordPlain)
    {
        $this->user = $user;
        $this->passwordPlain = $passwordPlain;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi Pendaftaran Santri Baru (PSB) - Darel Azhar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.psb-verify',
        );
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
