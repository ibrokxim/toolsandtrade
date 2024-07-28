<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'cities' => 'nullable|string',
        ]);

        $region = new Region($validated);
        $region->save();
        return redirect()->route('admin.regions.index')->with('success', 'Region created successfully!');
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'cities' => 'nullable|string',
        ]);

        $region = Region::findOrFail($id);
        $region->update($validated);

        return redirect()->route('admin.regions.index')->with('success', 'Region updated successfully!');
    }

    public function delete($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->route('admin.regions.index')->with('Region deleted successfully!');
    }
}
