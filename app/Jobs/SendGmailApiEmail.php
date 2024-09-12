<?php

namespace App\Jobs;

use App\Models\Token;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Contracts\Session\Session;

class SendGmailApiEmail implements ShouldQueue
{
    use Queueable;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $to;
    protected $replyto;
    protected $subject;
    protected $messageText;

    /**
     * Create a new job instance.
     */
    public function __construct($to, $replyto, $subject, $messageText)
    {
        $this->to = $to;
        $this->replyto = $replyto;
        $this->subject = $subject;
        $this->messageText = $messageText;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        // Retrieve the session token and set the access token
        $sessionId = session()->getId();
        $token = Token::where('session_id', $sessionId)->first();

        if ($token) {
            $client->setAccessToken($token->access_token);
        } else {
            // Handle the case where the token is missing
            // Log an error or throw an exception
            throw new \Exception("Access token not found for session");
        }

        $gmail = new Gmail($client);
        $gmailMessage = new Message();

        $rawMessageString = "To: {$this->to}\r\n";
        $rawMessageString = "ReplyTo: {$this->replyto}\r\n";
        $rawMessageString .= "Subject: {$this->subject}\r\n";
        $rawMessageString .= "Content-Type: text/plain; charset=utf-8\r\n\r\n";
        $rawMessageString .= $this->messageText;

        // Base64 encode and make it URL-safe
        $rawMessage = base64_encode($rawMessageString);
        $rawMessage = str_replace(['+', '/', '='], ['-', '_', ''], $rawMessage);
        $gmailMessage->setRaw($rawMessage);

        $result = $gmail->users_messages->send('me', $gmailMessage);
        return $result;
    }
}
