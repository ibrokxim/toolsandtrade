<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }
}
