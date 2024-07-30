<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;


// REGIONS
Route::get('regions', [RegionController::class, 'index']);

//BRANDS
Route::get('brands', [ManufacturerController::class, 'index']);
Route::get('brands/{slug}', [ManufacturerController::class, 'filterByBrand']);

//CATEGORIES
Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('categories/{slug}', [CategoryController::class, 'getCategoriesBySlugWithRelations']);
Route::get('big_category', [CategoryController::class, 'bigCategories']);

//MAIN
Route::get('/', [ProductController::class, 'showRandomProductsInMainPage']);

//PRODUCTS
Route::get('products', [ProductController::class, 'getAllProducts']);
Route::get('products/{slug}', [ProductController::class, 'showProduct']);

//SEARCH
Route::get('search', [SearchController::class, 'search']);

