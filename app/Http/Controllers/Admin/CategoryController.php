<?php

namespace App\Http\Controllers\Admin;

use App\Models\BigCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'big_category_id' => 'required|exists:big_categories,id',
        ]);

        $brand = new Category($validated);
        $brand->save();
        return redirect()->route('admin.categories.index')->with('success', 'Brand created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $bigCategories = BigCategory::all();
        return view('admin.categories.edit', compact('category', 'bigCategories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'big_category_id' => 'required|exists:big_categories,id',
        ]);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('Category deleted successfully');
    }
}
