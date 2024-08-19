<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFullResource extends JsonResource
{
    use SlugTrait;
    public static $wrap = null;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'short_description' => $this->short_description,
            'descripton' => $this->description,
            'characteristics' => $this->characteristics,
            'brand' => $this->manufacturers ? $this->manufacturers->name : null,
            'brand_slug' => $this->manufacturers ? $this->generateSlug($this->manufacturers->name) : null,
            'category' => $this->categories ? $this->categories->name : null,
            'category_slug' => $this->categories ? $this->generateSlug($this->categories->name) : null,
            'similar_products' => $this->getSimilarProducts()
        ];
    }

    private function getSimilarProducts()
    {
        $similarProducts = Product::query()
            ->where(function ($query) {
                $query->where('category_id', $this->category_id)
                    ->orWhere('manufacturer_id', $this->manufacturer_id);
            })
            ->where('id', '!=', $this->id)
            ->limit(10)
            ->get();

        return $similarProducts->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'short_description' => $product->short_description,
            ];
        });
    }
}
