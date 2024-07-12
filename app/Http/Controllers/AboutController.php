<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        $titles = [
            'Title', 
            'Our Vision', 
            'Our Mission', 
            'Customer Focus', 
            'Trust and Integrity', 
            'Teamwork', 
            'Adaptability', 
            'Responsibility', 
            'Product Solution Provider', 
            'Quality Product Leadership', 
            'Corporate Office', 
            'Vis-Min Office', 
            'Customer Support', 
            'Chat Support'
        ];

        $aboutData = [];
        foreach ($titles as $title) {
            $aboutData[$title] = About::where('title', $title)->first();
        }

        $aboutServices = Service::where('is_featured', true)
            ->latest('order')
            ->take(10)
            ->get();

        return view('about', [
            'aboutData' => $aboutData,
            'aboutServices' => $aboutServices,
        ]);
    }
}
