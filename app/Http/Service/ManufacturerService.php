<?php

namespace App\Http\Service;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerService
{
    public function filterManufacturers(Request $request)
    {
        $query = Manufacturer::query();
        if ($request->has('id')){
            $query->where('id',$request->name);
        }

        return $query;
    }
}
