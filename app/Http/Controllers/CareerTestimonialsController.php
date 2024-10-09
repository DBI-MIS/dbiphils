<?php

namespace App\Http\Controllers;

use App\Models\CareerTestimonial;
use Illuminate\Http\Request;

class CareerTestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = CareerTestimonial::orderBy('order','asc')->get();
       
    
        return view(
            'career-testimonials.index',
            [
                'career-testimonials' => $testimonials,
            ]
        );
    }
}
