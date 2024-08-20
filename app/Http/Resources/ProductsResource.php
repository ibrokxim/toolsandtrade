<?php

namespace App\Http\Resources;

use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    use SlugTrait;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->generateSlug($this->name),
            'image' => $this->image,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'characteristics' => $this->characteristics,
            'category_id' => $this->category_id,  // Явное указание
            'manufacturer_id' => $this->manufacturer_id,  // Явное указание
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
