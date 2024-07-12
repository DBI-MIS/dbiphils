<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProduct;
use App\Models\FeaturedProject;
use App\Models\Mainpage;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $featuredMainSlides = Mainpage::where('section', 'featured')
        ->latest('created_at')
        ->take(5)
        ->get();
        
        $featuredProducts = FeaturedProduct::where('is_featured', true)
        ->latest('created_at')
        ->take(10)
        ->get();

        $featuredTestimonials = Testimonial::where('is_featured', true)
        ->latest('created_at')
        ->take(4)
        ->get();

        $featuredServices = Service::where('is_featured', true)
        ->latest('order')
        ->take(10)
        ->get();

        $featuredNews = Post::where('is_featured', true)
        ->latest('published_at')
        ->take(3)
        ->get();

        $featuredProjects = Project::where('status', true)
        ->where('featured', true)
        ->latest('published_at')
        ->take(3)
        ->get();

        // $featuredProjects = Project::where('status', true)
        // ->where('featured', true)
        // ->latest('published_at')
        // ->take(20)
        // ->get();
    
        // $nonFeaturedProjects = Project::where('status', true)
        // ->where('featured', false)
        // ->latest('published_at')
        // ->take(100 - $featuredProjects->count())
        // ->get();

        // $projects = $featuredProjects->merge($nonFeaturedProjects);

        return view('home', [
            'featuredMainSlides' => $featuredMainSlides,
            'featuredProducts' => $featuredProducts,
            'featuredProjects' => $featuredProjects,
            'featuredTestimonials' => $featuredTestimonials,
            'featuredServices' => $featuredServices,
            'featuredNews' => $featuredNews,
        ]);
    }
}