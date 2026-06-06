<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $unsubscribeUrl) {}

    public function envelope(): Envelope {
        return new Envelope(subject: '📡 Inscription newsletter — Blog Télécom');
    }

    public function content(): Content {
        return new Content(markdown: 'emails.newsletter-confirm');
    }
}