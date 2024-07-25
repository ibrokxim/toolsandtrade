<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;

// REGIONS
Route::get('regions', [RegionController::class, 'index']);

//BRANDS
Route::get('brands', [ManufacturerController::class, 'index']);
Route::get('brands/{slug}', [ManufacturerController::class, 'filterByBrand']);

//CATEGORIES
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{slug}', [CategoryController::class, 'filterByCategory']);

//PRODUCTS
Route::get('products', [ProductController::class, 'index']);
