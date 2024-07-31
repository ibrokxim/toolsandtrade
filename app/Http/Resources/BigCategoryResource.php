<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BigCategoryResource extends JsonResource
{
    public static $wrap = null;
    public function toArray(Request $request): array
    {
        $slug = Str::slug($this->name);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug ?? $slug,
            'image' =>  $this->image ? asset('storage/' . $this->image) : null,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
