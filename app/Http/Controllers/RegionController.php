<?php

namespace App\Http\Controllers;

use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all()->keyBy('code')->map(function($region) {
            return [
                'id' => $region->id,
                'code' => $region->code,
                'name' => $region->name,
                'cities' => $region->cities,
            ];
        });

        return response()->json($regions);
    }
}
