<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Jorenvh\Share\ShareFacade;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $featuredProducts = Product::where('status', true)->where('featured',true)->latest('date_posted')->take(8)->get();

        // $featuredProducts = Cache::remember('featuredProducts', now()->addDay(), function () {
        //     return Product::where('status', true)->where('featured',true)->latest('date_posted')->take(6)->get();
        // });
        return view('products.index', [
            // 'featuredProducts' => $featuredProducts,
            'featuredProducts' => $featuredProducts,

        ]);
    }

    public function list()
    {
        $categories = Cache::remember('product_categories', now(), function () {
            return Category::whereHas('products', function ($query) {
                $query->published();
            })->take(20)->get();
        });

        return view('products.list', [
           
            'categories' => $categories,

        ]);
        //
    }

   
    public function show(Product $product)
    {

        $productUrl = route('products.show', $product->slug);
        $productTitle = $product->title;

        $shareComponent = ShareFacade::page($productUrl, $productTitle,
        [
            'class' => 'my-class',
            'id' => 'my-id',
            'title' => 'Share '. $productTitle,
            'rel' => 'nofollow noopener noreferrer'])
        ->facebook()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return view(
            'products.show',
            [
                'product' => $product,
                'shareComponent' => $shareComponent,
            ]
        );
    }


}
