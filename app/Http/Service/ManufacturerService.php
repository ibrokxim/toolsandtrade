<?php

namespace App\Http\Service;

use App\Models\Category;
use App\Traits\SlugTrait;
use App\Models\Manufacturer;
use App\Traits\PaginationTrait;
use App\Http\Resources\CategoryResource;

class ManufacturerService
{
    use PaginationTrait, SlugTrait;
    public function filterByBrands($slug)
    {
        $manufacturers = Manufacturer::all();
        $brand = $manufacturers->first(function ($manufacturer) use ($slug) {
            return $this->generateSlug($manufacturer->name) === $slug;
        });

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $products = $brand->products()->paginate(12);

        $categories = $this->getCategoriesWithProducts($brand);

        $categoriesResource = CategoryResource::collection($categories);
        return[
            'categories' => $categoriesResource,
            'brands' => $brand,
            'products' => $products,
            'pagination' => $this->paginate($products),
        ];
    }

    protected function getCategoriesWithProducts($brand)
    {
        return Category::whereHas('products', function($query) use ($brand) {
            $query->where('manufacturer_id', $brand->id);
        })->get();
    }



}
