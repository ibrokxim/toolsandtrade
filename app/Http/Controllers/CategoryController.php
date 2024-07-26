<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\BigCategoryController;
use App\Http\Resources\BigCategoryResource;
use App\Models\BigCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Http\Service\CategoryService;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request, CategoryService $categoryService)
    {
        $categories = $categoryService->filterCategory($request);
        return response()->json(CategoryResource::collection($categories));
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

    public function bigCategories()
    {
        $big_categories = BigCategory::with('categories')->get();
        return BigCategoryResource::collection($big_categories);
    }
}
