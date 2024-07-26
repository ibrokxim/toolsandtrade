<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BigCategory;
use Illuminate\Http\Request;

class BigCategoryController extends Controller
{
    public function index()
    {
        $big_categories = BigCategory::all();
        return view('admin.big_categories.index', compact('big_categories'));
    }
}
