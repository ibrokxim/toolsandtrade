<?php

namespace App\Http\Service;

use App\Models\Category;
use App\Models\BigCategory;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Traits\PaginationTrait;

class CategoryService
{
    use PaginationTrait;
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
        $category = $this->findCategoryBySlug($slug);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $brands = $this->getBrandsForCategory($category);
        $products = $category->products()->paginate(12);

        return[
            'category' => $category,
            'brands' => $this->formatBrands($brands),
            'products' => $products,
            'pagination' => $this->paginate($products)
            ];
    }

    public function getBigCategoryWithRelations($slug)
    {
        $big_category = $this->findBigCategoryBySlug($slug);

        if (!$big_category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $categories = $this->getCategoriesForBigCategory($big_category);

        $brands = $this->getBrandsForCategory($categories->pluck('id')->toArray());

        return [
            'big_category' => $this->formatBigCategory($big_category),
            'categories' => $this->formatCategories($categories),
            'products' => $this->formatedProducts($categories),
            'brands' => $this->formatBrands($brands),

        ];
    }

    public function findCategoryBySlug($slug): Category
    {
        $slug = str_replace('-', ' ', $slug);
        return Category::where('name', 'like', '%' . $slug . '%')->first();
    }

    public function findBigCategoryBySlug($slug): BigCategory
    {
        $slug = str_replace('-', ' ', $slug);
        return BigCategory::where('name', 'like', '%' . $slug . '%')->first();
    }

    public function getBrandsForCategory($categoryIDS)
    {
        return Manufacturer::whereHas('products', function ($query) use ($categoryIDS) {
           $query->whereIn('category_id', $categoryIDS);
        })->get(['id', 'name']);
    }

    private function getCategoriesForBigCategory($big_category)
    {
        return Category::where('big_category_id', $big_category->id)
            ->get(['id', 'name']);
    }

    private function generateSlug($name): array|string|null
    {
        $slug = str_slug($name);
        $slug = str_replace('-', ' ', $slug);
        return preg_replace('/[^a-zA-Z0-9-]/', '', $slug);
    }

    private function formatBigCategory($bigCategory): array
    {
        return [
            'id' => $bigCategory->id,
            'name' => $bigCategory->name,
            'slug' => $this->generateSlug($bigCategory->name),
        ];
    }

    private function formatBrands($brands)
    {
        return $brands->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'slug' => $this->generateSlug($brand->name),
            ];
        })->toArray();
    }

    private function formatCategories($categories)
    {
        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $this->generateSlug($category->name),
            ];
        });
    }
    private function formatedProducts($categories)
    {
        return $categories->flatMap(function ($category) {
            return $category->products->map(function ($product) use ($category) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'short_description' => $product->short_description,
                    'image' => $product->image,
                    'category_id' => $category->id,
                ];
            });
        });
    }
}
