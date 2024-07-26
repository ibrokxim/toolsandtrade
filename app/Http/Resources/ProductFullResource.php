<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFullResource extends JsonResource
{
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
            'category_id' => $this->category_id,
            'manufacturer_id' => $this->manufacturer_id,
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
                'image' => $product->image,
            ];
        });
    }
}
