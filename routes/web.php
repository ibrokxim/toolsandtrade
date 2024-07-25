<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product.index');

    Route::get('region/index', [RegionController::class, 'index'])->name('admin.regions.index');
});
