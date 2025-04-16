<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class Newslettere extends Mailable
{
    use Queueable, SerializesModels;

    public string $title;
    public string $content;

    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('joncivenzeus@gmail.com', 'Mailmaster'),
            subject: $this->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'newslettere',
            with: [
                'title' => $this->title,
                'content' => $this->content,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
