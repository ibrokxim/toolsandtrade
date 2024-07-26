<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;

//MAIN
Route::get('/', [ProductController::class, 'main']);
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
Route::get('products/{slug}', [ProductController::class, 'show']);

//SEARCH
Route::get('search', [SearchController::class, 'search']);

