<?php

namespace App\Http\Service;

use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchService
{
    public function searchByAllTypes(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'No search query provided'], 400);
        }

        $manufacturers = Manufacturer::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', DB::raw("REPLACE(LOWER(name), ' ', '-') as slug"))
            ->paginate(15);

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', DB::raw("REPLACE(LOWER(name), ' ', '-') as slug"))
            ->paginate(15);

        $products = Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('short_description', 'LIKE', "%{$query}%");
        })
            ->select('id', 'name', 'short_description', 'description', 'image')
            ->paginate(15);

        $productsData = collect($products->items())->map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'short_description' => $product['short_description'],
                'image' => $product['image'],
            ];
        });
        return [
        'manufacturers' => [
            'data' => $manufacturers->items(),
            'pagination' => [
                'total' => $manufacturers->total(),
                'per_page' => $manufacturers->perPage(),
                'current_page' => $manufacturers->currentPage(),
                'last_page' => $manufacturers->lastPage(),
                'next_page_url' => $manufacturers->nextPageUrl(),
                'prev_page_url' => $manufacturers->previousPageUrl(),
            ],
        ],
        'categories' => [
            'data' => $categories->items(),
            'pagination' => [
                'total' => $categories->total(),
                'per_page' => $categories->perPage(),
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'next_page_url' => $categories->nextPageUrl(),
                'prev_page_url' => $categories->previousPageUrl(),
            ],
        ],
        'products' => [
            'data' => $productsData,
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ],
        ];
    }

}
