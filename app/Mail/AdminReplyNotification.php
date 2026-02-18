<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminReplyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $message;
    public string $reply;

    public function __construct(ContactMessage $message, string $reply)
    {
        $this->message = $message;
        $this->reply = $reply;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: ' . $this->message->subject . ' - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-reply',
        );
    }
}