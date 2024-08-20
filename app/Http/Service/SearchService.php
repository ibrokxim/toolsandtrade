<?php

namespace App\Http\Service;

use App\Models\Product;
use App\Models\Category;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\DB;

class SearchService
{
    use PaginationTrait, SlugTrait;
    public function searchManufacturers(Request $request)
    {
        $query = $request->input('query');
        $manufacturers = Manufacturer::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', DB::raw("REPLACE(LOWER(name), ' ', '-') as slug"))
            ->paginate(15);
        return $manufacturers;
    }

    public function searchCategories(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', DB::raw("REPLACE(LOWER(name), ' ', '-') as slug"))
            ->paginate(15);
        return $categories;
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('short_description', 'LIKE', "%{$query}%");
        })
            ->select('id', 'name', 'short_description', 'description', 'image')
            ->paginate(15);

        $productsData = collect($products->items())->map(function ($product) {
            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'slug' => $this->generateSlug($product['name']),
                'short_description' => $product['short_description'],
                'image' => $product['image'],
            ];
        });
        return [
            'data' => $productsData,
            'pagination' => $this->paginate($products),
        ];
    }


    public function searchByAllTypes(Request $request)
    {
        $products = $this->searchProducts($request);
        $categories = $this->searchCategories($request);
        $manufacturers = $this->searchManufacturers($request);

        return [
        'manufacturers' => [
            'data' => $manufacturers->items(),
            'pagination' => $this->paginate($manufacturers),
        ],
        'categories' => [
            'data' => $categories->items(),
            'pagination' => $this->paginate($categories),
        ],
            'products'=>$products
        ];
    }

}
