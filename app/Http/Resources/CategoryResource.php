<?php

namespace App\Http\Resources;

use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use SlugTrait;
    public static $wrap = null;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
//            'description' => $this->description,
//            'image' => $this->image,
            'slug' => $this->generateSlug($this->name),
        ];
    }
}
