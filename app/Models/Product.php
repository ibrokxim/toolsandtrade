<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image',
                           'short_description', 'description',
                           'characteristics', 'manufacturer', 'category_id',
                           'manufacturer_id',
    ];

    public function manufacturers(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSlugAttribute()
    {
        $slug = strtolower($this->name);

        $slug = str_replace(' ', '-', $slug);

        $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $slug);

        return $slug;
    }

}
