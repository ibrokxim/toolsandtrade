<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function delete($id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('Category deleted successfully');
    }
}
