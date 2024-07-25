<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFullResource extends JsonResource
{

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
        ];
    }
}
