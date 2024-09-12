<?php

namespace App\Mail;

use App\Models\MainResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MainFormResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public MainResponse $formresponse
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('info@dbiphils.com', 'Inquiry Notification'),
            replyTo: [
                new Address($this->formresponse->email, $this->formresponse->name),
            ],
            subject: 'Inquiry for ' . $this->formresponse->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.form.mainresponse',
            with: [
                'subject' => $this->formresponse->subject,
                'name' => $this->formresponse->name,
                'contact' => $this->formresponse->contact,
                'email' => $this->formresponse->email,
                'message' => $this->formresponse->message,
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
        return [];
    }
}
