<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function filterByCategory($slug)
    {

        $categories = Category::where('name', $slug)->first();
        if (!$categories) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $brand = Manufacturer::whereHas('products', function ($query) use ($categories) {
            $query->where('category_id', $categories->id);
        })->get();

        $products = $categories->products()->paginate(12);

        return response()->json([
           'categories' => $categories,
           'brand' => $brand,
           'products' => $products,
        ]);
    }
}
