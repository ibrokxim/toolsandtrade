<?php

namespace App\Http\Service;

use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class CategoryService
{
    public function filterCategories(Request $request)
    {
        $query = Category::query();
        if ($request->has('id')){
            $query->where('id',$request->id);
        }

        return $query->get();
    }

    public function getCategoryWithRelations($slug)
    {
        $slug = str_replace('-', ' ', $slug);
        $categories = Category::where('name', 'like', '%' . $slug . '%')->first();

        if (!$categories) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $brands = Manufacturer::whereHas('products', function ($query) use ($categories) {
            $query->where('category_id', $categories->id);
        })->get(['id', 'name']);

        $brandsWithSlugs = $brands->map(function ($brand) {
            $slug = strtolower($brand->name);
            $slug = str_replace(' ', '-', $slug);
            $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $slug);

            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'slug' => $slug,
            ];
        });
        $products = $categories->products()->paginate(12);

        return[
            'categories' => $categories,
            'brands' => $brandsWithSlugs,
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
