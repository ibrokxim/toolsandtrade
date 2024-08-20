<?php

namespace App\Http\Service;

use App\Models\Product;
use App\Models\Category;
use App\Traits\SlugTrait;
use App\Models\BigCategory;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Traits\PaginationTrait;
use App\Http\Resources\ProductsResource;

class CategoryService
{
    use PaginationTrait, SlugTrait;
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
        $categories = Category::all();
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $categoryID = [$category->id];
        $brands = $this->getBrandsForCategory($categoryID);
        $products = $category->products()->paginate(16);
        $productResources = ProductsResource::collection($products->getCollection());


        return[
            'categories' => $category,
            'all_categories' => $categories,
            'brands' => $this->formatBrands($brands),
            'products' => [
                'current_page' => $products->currentPage(),
                'data' => $productResources,
            ],
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

        $products = $this->formatedProducts($categories);
        $products->getCollection()->transform(function ($product) {
            $product->slug = $this->generateSlug($product->name);
            return $product;
        });
        return [
            'big_category' => $this->formatBigCategory($big_category),
            'categories' => $this->formatCategories($categories),
            'products' => $products,
            'brands' => $this->formatBrands($brands),
            'pagination' => $this->paginate($products)
        ];
    }

    public function findCategoryBySlug($slug)
    {
       $categories = Category::all();
       $matchingCategory = null;

       foreach ($categories as $category) {
            $generatedSlug = $this->generateSlug($category->name);
            if ($generatedSlug === $slug) {
                $matchingCategory = $category;
                break;
            }
       }
        return $matchingCategory;
    }

    public function findBigCategoryBySlug($slug)
    {
        $categories = BigCategory::all();
        $matchingCategory = null;

        foreach ($categories as $category) {
            $generatedSlug = $this->generateSlug($category->name);
            if ($generatedSlug === $slug) {
                $matchingCategory = $category;
                break;
            }
        }
        return $matchingCategory;
    }

    public function getBrandsForCategory($categoryIDS)
    {
        if (!is_array($categoryIDS)) {
            $categoryIDS = [$categoryIDS];
        }
        return Manufacturer::whereHas('products', function ($query) use ($categoryIDS) {
           $query->whereIn('category_id', $categoryIDS);
        })->get(['id', 'name']);
    }

    private function getCategoriesForBigCategory($big_category)
    {
        return Category::where('big_category_id', $big_category->id)
            ->get(['id', 'name']);
    }

    private function formatBigCategory($bigCategory)
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
        $productsQuery = Product::whereIn('category_id', $categories->pluck('id'))
            ->select('id', 'name', 'slug', 'short_description', 'image', 'category_id');

        return $productsQuery->paginate(16);
    }
}
