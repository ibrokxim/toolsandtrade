<?php

namespace App\Http\Controllers;

use App\Http\Resources\ManufacturerResource;
use App\Models\Category;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return ManufacturerResource::collection($manufacturers);
    }

    public function filterByBrand($slug)
    {

        $brand = Manufacturer::where('name', $slug)->first();
        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $categories = Category::whereHas('products', function($query) use ($brand) {
            $query->where('manufacturer_id', $brand->id);
        })->get();

        $products = $brand->products()->paginate(12);

        return response()->json([
            'categories' => $categories,
            'brands' => $brand,
            'products' => $products,
        ]);
    }

}
