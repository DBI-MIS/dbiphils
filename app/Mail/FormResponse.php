<?php

namespace App\Mail;

use App\Models\JobResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Http\Client\Request;

class FormResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(

        public JobResponse $formresponse
    ) {
        
        // $client = new Client();
        // $client->setClientId(env('GOOGLE_CLIENT_ID'));
        // $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        // $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        // $client->setAccessToken($this->getAccessToken());
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('info@dbiphils.com', 'Job Notification'),
            replyTo: [
                new Address($this->formresponse->email_address, $this->formresponse->full_name),
            ],
            subject: 'Job Application for ' . $this->formresponse->job_post->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.form.response',
            with: [
                'job_title' => $this->formresponse->job_post->title,
                'name' => $this->formresponse->full_name,
                'date' => $this->formresponse->date,
                'contact' => $this->formresponse->contact,
                'email_address' => $this->formresponse->email_address,
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
        // return [];

        return [
            Attachment::fromPath('storage/' . $this->formresponse->attachment),
        ];
    }

}
