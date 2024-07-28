<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductFullResource;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = $request->query('cats');
        $productQuery = Product::query();
        if($categories){
            $categoryId = explode(',',$categories);
            $productQuery->whereIn('category_id',$categoryId);
        }

        $products = $productQuery->paginate(16);
        return response()->json([
        'data' => ProductResource::collection($products),
        'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
    ]);
}

    public function show($slug)
    {
        $product = Product::with('categories', 'manufacturers')
            ->where('name', $slug)
            ->firstOrFail();
        return new ProductFullResource($product);
    }

    public function main()
    {
        $products = Product::inRandomOrder()->limit(3)->get();
        return response()->json(ProductResource::collection($products));
    }
}
