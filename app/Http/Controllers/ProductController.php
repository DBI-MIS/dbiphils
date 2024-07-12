<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(
            'products.show',
            [
                'product' => $product,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
