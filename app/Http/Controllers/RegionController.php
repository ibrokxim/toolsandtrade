<?php

namespace App\Http\Controllers;

use App\Http\Service\RegionService;

class RegionController extends Controller
{
    public function index(RegionService $service)
    {
        $regions = $service->getRegionViaCode();
        return response()->json($regions);
    }
}
