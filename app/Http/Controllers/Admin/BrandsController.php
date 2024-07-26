<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Manufacturer::query()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function delete($id)
    {
        $brand = Manufacturer::findOrFail($id);
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('Region deleted successfully');
    }
}
