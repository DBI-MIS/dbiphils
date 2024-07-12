<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class EPHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    
    {

        return view('ephome', [
            
            'featuredProducts' => Product::where('status', true)
            ->where('featured',true)
            // ->where('equipment_header','EP Solutions') ->query with Section
            ->wherehas('product_brand', function($q) {
                $q->where('name','EP Solutions');
            })
            ->latest('date_posted')
            ->take(4)->get(),

        ]);
    }
}
