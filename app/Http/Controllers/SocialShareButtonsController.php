<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jorenvh\Share\Share;

class SocialShareButtonsController extends Controller
{
    public function ShareWidget()
    {
        $shareComponent = Share::page('https://dbiphils.com', 'test')
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        return view('posts.show', compact('shareComponent'));
    }
}
