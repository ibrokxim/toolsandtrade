<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getSlugAttribute()
    {
        $slug = strtolower($this->name);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $slug);
        return $slug;
    }

}
