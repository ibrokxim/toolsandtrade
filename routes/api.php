<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ManufacturerController;


Route::get('regions', [RegionController::class, 'index']);
Route::get('manufacturers', [ManufacturerController::class, 'index']);
