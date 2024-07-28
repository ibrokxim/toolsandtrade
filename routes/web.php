<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BigCategoryController;


Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    //Products
    Route::get('/products/index', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::put('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
    //Brands
    Route::get('/brands/index', [BrandsController::class, 'index'])->name('admin.brands.index');
    Route::get('/brands/create', [BrandsController::class, 'create'])->name('admin.brands.create');
    Route::post('/brands/store', [BrandsController::class, 'store'])->name('admin.brands.store');
    Route::get('/brands/edit/{id}', [BrandsController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/brands/update/{id}', [BrandsController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/delete/{id}', [BrandsController::class, 'delete'])->name('admin.brands.delete');
    //Regions
    Route::get('/regions/index', [RegionController::class, 'index'])->name('admin.regions.index');
    Route::get('regions/create', [RegionController::class, 'create'])->name('admin.regions.create');
    Route::post('/regions/store', [RegionController::class, 'store'])->name('admin.regions.store');
    Route::get('/regions/edit/{id}', [RegionController::class, 'edit'])->name('admin.regions.edit');
    Route::put('/regions/update/{id}', [RegionController::class, 'update'])->name('admin.regions.update');
    Route::delete('/regions/delete/{id}', [RegionController::class, 'delete'])->name('admin.regions.delete');
    //Categories
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    //Big Categories
    Route::get('/big_categories/index', [BigCategoryController::class, 'index'])->name('admin.big_categories.index');
    Route::get('/big_categories/create', [BigCategoryController::class, 'create'])->name('admin.big_categories.create');
    Route::post('/big_categories/store', [BigCategoryController::class, 'store'])->name('admin.big_categories.store');
    Route::get('/big_categories/edit/{id}', [BigCategoryController::class, 'edit'])->name('admin.big_categories.edit');
    Route::put('/big_categories/update/{id}', [BigCategoryController::class, 'update'])->name('admin.big_categories.update');
    Route::delete('/big_categories/delete/{id}', [BigCategoryController::class, 'delete'])->name('admin.big_categories.delete');
});
