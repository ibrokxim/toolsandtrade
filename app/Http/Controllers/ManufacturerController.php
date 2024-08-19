<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Service\ManufacturerService;
use App\Http\Resources\ManufacturerResource;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return response()->json(ManufacturerResource::collection($manufacturers));
    }

    public function filterByBrand($slug, ManufacturerService $manufacturerService, Request $request)
    {
        $filterBrands = $manufacturerService->filterByBrands($slug, $request);
        return response()->json($filterBrands);
    }

}
