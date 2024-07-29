<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ManufacturerResource;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return response()->json(ManufacturerResource::collection($manufacturers));
    }

    public function filterByBrand($slug)
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
        return response()->json([
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
        ]);
    }

}
