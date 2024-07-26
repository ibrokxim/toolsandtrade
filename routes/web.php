<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;


Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product.index');
    //Brands
    Route::get('/brands/index', [BrandsController::class, 'index'])->name('admin.brands.index');
    Route::post('/brands/create', [BrandsController::class, 'create'])->name('admin.brands.create');
    Route::get('/brands/edit/{id}', [BrandsController::class, 'edit'])->name('admin.brands.edit');
    Route::post('/brands/update/{id}', [BrandsController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/delete/{id}', [BrandsController::class, 'delete'])->name('admin.brands.delete');
    //Regions
    Route::get('/regions/index', [RegionController::class, 'index'])->name('admin.regions.index');
    Route::post('/regions/create', [RegionController::class, 'create'])->name('admin.regions.create');
    Route::get('/regions/createForm', [RegionController::class, 'createForm'])->name('admin.regions.createForm');
    Route::get('/regions/edit/{id}', [RegionController::class, 'edit'])->name('admin.regions.edit');
    Route::get('/regions/update/{id}', [RegionController::class, 'update'])->name('admin.regions.update');
    Route::delete('/regions/delete/{id}', [RegionController::class, 'delete'])->name('admin.regions.delete');
    //Categories
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');





});
