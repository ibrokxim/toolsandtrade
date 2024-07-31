<?php

namespace App\Http\Controllers;

use App\Models\BigCategory;
use Illuminate\Http\Request;
use App\Http\Service\CategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BigCategoryResource;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function getCategories(Request $request)
    {
        $categories = $this->categoryService->filterCategories($request);
        return response()->json(CategoryResource::collection($categories));
    }

    public function getCategoriesBySlugWithRelations($slug)
    {
        $categoryBySlug = $this->categoryService->getCategoryWithRelations($slug);
        return response()->json($categoryBySlug);
    }

    public function bigCategories()
    {
        $big_categories = BigCategory::with('categories')->get();
        return response()->json(BigCategoryResource::collection($big_categories));
    }

    public function bigCategoriesBySlug($slug)
    {
        $big_category = $this->categoryService->getBigCategoryWithRelations($slug);
        return response()->json($big_category);
    }
}
