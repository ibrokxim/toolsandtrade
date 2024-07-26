<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BigCategoryResource extends JsonResource
{

    public static $wrap = null;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),

        ];
    }
}
