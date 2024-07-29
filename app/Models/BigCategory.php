<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BigCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','image'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

}
