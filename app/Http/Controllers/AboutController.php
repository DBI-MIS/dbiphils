<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {

        $aboutTitle = About::where('title', 'Title')->first();

        $aboutVision = About::where('title', 'Our Vision')->first();

        $aboutMission = About::where('title', 'Our Mission')->first();

        $aboutValues1 = About::where('title', 'Our Core Values - Customer Focus')->first();

        $aboutValues2 = About::where('title', 'Our Core Values - Trust and Integrity')->first();

        $aboutValues3 = About::where('title', 'Our Core Values - Teamwork')->first();

        $aboutValues4 = About::where('title', 'Our Core Values - Adaptability')->first();

        $aboutValues5 = About::where('title', 'Our Core Values - Responsibilty')->first();

        $aboutValues6 = About::where('title', 'Our Core Values - Product Solution Provider')->first();

        $aboutValues7 = About::where('title', 'Our Core Values - Quality Product Leadership')->first();

        $aboutCorporateOffice = About::where('title', 'Corporate Office')->first();

        $aboutVisMinOffice = About::where('title', 'Vis-Min Office')->first();

        $aboutServices = Service::where('is_featured', true)
        ->latest('order')
        ->take(10)
        ->get();

     

        return view('about', [
            'aboutTitle' => $aboutTitle,
            'aboutVision' => $aboutVision,
            'aboutMission' => $aboutMission,
            'aboutValues1' => $aboutValues1,
            'aboutValues2' => $aboutValues2,
            'aboutValues3' => $aboutValues3,
            'aboutValues4' => $aboutValues4,
            'aboutValues5' => $aboutValues5,
            'aboutValues6' => $aboutValues6,
            'aboutValues7' => $aboutValues7,
            'aboutCorporateOffice' => $aboutCorporateOffice,
            'aboutVisMinOffice' => $aboutVisMinOffice,
            'aboutServices' => $aboutServices,
         
        ]);
    }
}
