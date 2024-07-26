<?php

namespace App\Http\Service;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function filterCategory(Request $request)
    {
        $query = Category::query();
        if ($request->has('id')){
            $query->where('id',$request->id);
        }

        return $query->get();
    }
}
