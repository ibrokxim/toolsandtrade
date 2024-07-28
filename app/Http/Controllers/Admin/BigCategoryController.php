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

    public function create()
    {
        return view('admin.big_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $big_category = new BigCategory($validated);
        $big_category->save();
        return redirect()->route('admin.big_categories.index')->with('Big Category Added Successfully');
    }

    public function edit($id)
    {
        $big_category = BigCategory::findOrFail($id);
        return view('admin.big_categories.edit', compact('big_category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $big_category = BigCategory::findOrFail($id);
        $big_category->update($validated);
        return redirect()->route('admin.big_categories.index')->with('Big Category Updated Successfully');
    }

    public function delete($id)
    {
        $big_category = BigCategory::findOrFail($id);
        $big_category->delete();
        return redirect()->route('admin.big_categories.index')->with('Big Category Deleted Successfully');
    }
}
