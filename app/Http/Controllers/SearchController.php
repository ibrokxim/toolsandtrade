<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'No search query provided'], 400);
        }


        $manufacturers = Manufacturer::where('name', 'LIKE', "%{$query}%")->get();

        $categories = Category::where('name', 'LIKE', "%{$query}%")->get();

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
