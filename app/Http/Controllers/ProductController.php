<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductFullResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(16);
        return response()->json([ProductResource::collection($products)]);
    }

    public function show($slug)
    {
        $product = Product::where('name', $slug)->firstOrFail();
        return new ProductFullResource($product);
    }
}
