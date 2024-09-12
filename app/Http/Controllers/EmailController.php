<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Illuminate\Support\Facades\Session;
use App\Models\Token;

class EmailController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope(Gmail::GMAIL_SEND);
    }

    public function handleCallback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect('/')->with('error', 'Authorization code not available');
        }
    
        $tokenData = $this->client->fetchAccessTokenWithAuthCode($request->query('code'));
    
        if (isset($tokenData['error'])) {
            return redirect('/')->with('error', 'Failed to get access token');
        }
    
        // Get the session ID for the guest user
        $sessionId = Session::getId();
    
        // Store the token in the database with the session ID
        Token::updateOrCreate(
            ['session_id' => $sessionId],  // Update if the session already has a token
            [
                'access_token' => $tokenData['access_token'],
                'refresh_token' => $tokenData['refresh_token'] ?? null,
                'expires_in' => $tokenData['expires_in'] ?? null,
            ]
        );
    
        $this->client->setAccessToken($tokenData);
    
        // Send an email or other actions
        $this->sendHtmlEmail();

        return redirect('/')->with('success', 'Token stored successfully');
    }

    public function redirectToAuthUrl()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }
    

    public function sendHtmlEmail()
    {
        $to = 'desktoppublisher@dbiphils.com';
        $subject = 'Hello, HTML Email!';
        $htmlContent = '<h1>Welcome to Our Service</h1><p>This is a <strong>HTML</strong> email, sent via the <em>Gmail API</em>.</p>';

        // MIME Type message
        $boundary = uniqid(rand(), true);
        $subjectCharset = $charset = 'utf-8';

        $messageBody = "--{$boundary}\r\n";
        $messageBody .= "Content-Type: text/html; charset={$charset}\r\n";
        $messageBody .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";
        $messageBody .= "{$htmlContent}\r\n";
        $messageBody .= "--{$boundary}--";

        $rawMessage = "To: {$to}\r\n";
        $rawMessage .= "Subject: =?{$subjectCharset}?B?" . base64_encode($subject) . "?=\r\n";
        $rawMessage .= "MIME-Version: 1.0\r\n";
        $rawMessage .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n\r\n";
        $rawMessage .= $messageBody;

        $rawMessage = base64_encode($rawMessage);
        $rawMessage = str_replace(['+', '/', '='], ['-', '_', ''], $rawMessage); // URL-safe

        $gmailMessage = new Message();
        $gmailMessage->setRaw($rawMessage);

        $service = new Gmail($this->client);
        try {
            $service->users_messages->send('me', $gmailMessage);
            return 'HTML email sent successfully.';
        } catch (\Exception $e) {
            return 'An error occurred: ' . $e->getMessage();
        }
    }
}
