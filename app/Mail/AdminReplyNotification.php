<?php

namespace App\Mail;  // This MUST be exactly this

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminReplyNotification extends Mailable  // Class name MUST match filename
{
    use Queueable, SerializesModels;

    public ContactMessage $contactMessage;
    public string $replyMessage;

    public function __construct(ContactMessage $contactMessage, string $replyMessage)
    {
        $this->contactMessage = $contactMessage;
        $this->replyMessage = $replyMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: ' . $this->contactMessage->subject . ' - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-reply',
        );
    }
}