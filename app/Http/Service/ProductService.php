<?php

namespace App\Http\Service;

use App\Models\Product;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use App\Http\Resources\ProductResource;

class ProductService
{
    use PaginationTrait, SlugTrait;
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
            'pagination' => $this->paginate($products),
        ];
        return $query;
    }

    public function showProduct($slug)
    {
        $slug = $this->generateSlug($slug);
        $product = Product::with('categories', 'manufacturers')
            ->whereRaw(     'LOWER(
                REPLACE(
                    REPLACE(
                        REPLACE(
                            REPLACE(REPLACE(name, "&", "and"), "/", "-"),
                        ",", "-"),
                    ".", "-"),
                " ", "-")
            ) LIKE ?',
                ['%' . $slug . '%'])
            ->firstOrFail();
        return $product;
    }

    public function randomProducts()
    {
        $products = Product::inRandomOrder()->limit(10)->get();
        return $products;
    }
}
