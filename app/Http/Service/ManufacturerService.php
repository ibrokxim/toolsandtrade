<?php

namespace App\Http\Service;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Http\Resources\CategoryResource;

class ManufacturerService
{
    public function filterByBrands($slug)
    {
        $slug = str_replace('-', ' ', $slug);

        $brand = Manufacturer::where('name', 'like', '%' . $slug . '%')->first();

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $products = $brand->products()->paginate(12);

        $categories = Category::whereHas('products', function($query) use ($brand) {
            $query->where('manufacturer_id', $brand->id);
        })->get();

        $categoriesResource = CategoryResource::collection($categories);
        return[
            'categories' => $categoriesResource,
            'brands' => $brand,
            'products' => $products,
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ];
    }
}
