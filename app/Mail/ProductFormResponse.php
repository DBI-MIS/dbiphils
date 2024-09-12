<?php

namespace App\Mail;

use App\Models\ProductResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductFormResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public ProductResponse $formresponse
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
            from: new Address('info@dbiphils.com', 'Product Inquiry'),
            replyTo: [
                new Address($this->formresponse->email_address, $this->formresponse->full_name),
            ],
            subject: 'Product Inquiry for ' . $this->formresponse->product->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       
        return new Content(
            markdown: 'mail.form.productresponse',
            with: [
                'product' => $this->formresponse->product->title,
                'name' => $this->formresponse->full_name,
                'contact' => $this->formresponse->contact,
                'email' => $this->formresponse->email_address,
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
