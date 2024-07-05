<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProject;
use App\Models\Mainpage;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        

        $featuredSlides = Mainpage::where('section', 'slider')
        ->latest('created_at')
        ->take(10)
        ->get();
        
        $featuredProducts = Mainpage::where('section', 'featured')
        ->latest('created_at')
        ->take(10)
        ->get();

        $featuredProjects = FeaturedProject::where('is_featured', true)
        ->latest('created_at')
        ->take(10)
        ->get();

        $featuredTestimonials = Testimonial::where('is_featured', true)
        ->latest('created_at')
        ->take(4)
        ->get();


        return view('home', [
            'featuredSlides' => $featuredSlides,
            'featuredProducts' => $featuredProducts,
            'featuredProjects' => $featuredProjects,
            'featuredTestimonials' => $featuredTestimonials,
        ]);
    }
}