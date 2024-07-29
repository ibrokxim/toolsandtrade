<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\BigCategory;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Http\Service\CategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BigCategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request, CategoryService $categoryService)
    {
        $categories = $categoryService->filterCategory($request);
        return response()->json(CategoryResource::collection($categories));
    }

    public function filterByCategory($slug)
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

        return response()->json([
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
        ]);
    }

    public function bigCategories()
    {
        $big_categories = BigCategory::with('categories')->get();
        return response()->json(BigCategoryResource::collection($big_categories));
    }
}
