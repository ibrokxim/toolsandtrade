<?php

namespace App\Http\Service;

use App\Models\Region;

class RegionService
{
    public function getRegionViaCode()
    {
        return Region::all()->keyBy('code')->map(function($region) {
            return [
                'id' => $region->id,
                'code' => $region->code,
                'name' => $region->name,
                'cities' => $region->cities,
            ];
        });
    }
}
