<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $type;
    public $filesName;
    public $customerName;
    public $subject;
    public function __construct($type,$filesName, $customerName,$subject)
    {
        $this->type = $type;
        $this->filesName = $filesName;
        $this->customerName = $customerName;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from('Info@Domain.de')
            ->to($this->customerName)
            ->cc('Domain.admin@gmail.com')
            ->subject($this->subject)
            ->view('$this->type/email/$this->type');
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
