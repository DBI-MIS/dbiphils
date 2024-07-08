<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
       
    
        return view(
            'testimonials.index',
            [
                'testimonials' => $testimonials,
            ]
        );
    }
}