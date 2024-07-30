<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Http\Service\ManufacturerService;
use App\Http\Resources\ManufacturerResource;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return response()->json(ManufacturerResource::collection($manufacturers));
    }

    public function filterByBrand($slug, ManufacturerService $manufacturerService)
    {
        $filterBrands = $manufacturerService->filterByBrands($slug);
        return response()->json($filterBrands);
    }

}
