<?php

namespace App\Http\Service;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductService
{
    public function getProducts(Request $request)
    {
        $categories = $request->query('cats');
        $productQuery = Product::query();
        if($categories){
            $categoryId = explode(',',$categories);
            $productQuery->whereIn('category_id',$categoryId);
        }

        $products = $productQuery->paginate(15);
        $query = [
            'data' => ProductResource::collection($products),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ];
        return $query;
    }

    public function showProduct($slug)
    {
        $product = Product::with('categories', 'manufacturers')
            ->where('name', $slug)
            ->firstOrFail();
        return $product;
    }

    public function randomProducts()
    {
        $products = Product::inRandomOrder()->limit(10)->get();
        return $products;
    }
}
