<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductResponse;
use Illuminate\Http\Request;

class ProductResponseController extends Controller
{
    public function show(ProductResponse $product)
    {
        return view(
            'products.create-product-response',
            [
                'product' => $product,
                'product_title' => $product->title,
                
            ]
        );
    }
}
