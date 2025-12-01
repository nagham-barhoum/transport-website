<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedBackMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->to('Info@Domain.de')
            ->setAddress($this->data['email'])
            ->replyTo($this->data['email'], $this->data['name']) // Set the "Reply-To" field to the user's email
            ->subject('Domain Transport')
            ->view('emails.feedback')
            ->with($this->data);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Domain Transport',
        );
    }

}
