<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'No search query provided'], 400);
        }


        $manufacturers = Manufacturer::where('name', 'LIKE', "%{$query}%")
            ->get()
            ->map(function ($manufacturer) {
                return [
                    'id' => $manufacturer->id,
                    'name' => $manufacturer->name,
                    'slug' => $manufacturer->slug,
                ];
            });

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                ];
            });;

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('short_description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json([
            'manufacturers' => $manufacturers,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
