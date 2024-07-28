<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BrandsController extends Controller
{
    public function index()
    {
        $brands = Manufacturer::query()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
        ]);

        $brand = new Manufacturer($validated);
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully!');
    }

    public function edit($id)
    {
        $brand = Manufacturer::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $brand = Manufacturer::findOrFail($id);
        $brand->update($validatedData);
        return redirect()->route('admin.brands.index')->with('Brand updated successfully!');
    }


    public function delete($id)
    {
        $brand = Manufacturer::findOrFail($id);
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('Region deleted successfully');
    }
}
