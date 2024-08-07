<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BigCategoryController;

Route::middleware(['admin'])->group(function () {
    Route::get('{country}/admin', [AuthController::class, 'login'])->name('admin.login');
//    Route::get('/admin/{any?}', function () {
//        return redirect()->route('admin.login');
//    })->where('any', '.*');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    //Products
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
    });
//    Route::resource('products', ProductController::class)->names([
//        'index' => 'admin.products.index',
//        'create' => 'admin.products.create',
//        'store' => 'admin.products.store',
//        'edit' => 'admin.products.edit',
//        'update' => 'admin.products.update',
//        'destroy' => 'admin.products.delete',
//    ])->except('show');

    //Brands
    Route::resource('brands', BrandsController::class)->names([
        'index' => 'admin.brands.index',
        'create' => 'admin.brands.create',
        'store' => 'admin.brands.store',
        'edit' => 'admin.brands.edit',
        'update' => 'admin.brands.update',
        'destroy' => 'admin.brands.delete',
    ]);

    //Regions
    Route::resource('regions', RegionController::class)->names([
        'index' => 'admin.regions.index',
        'create' => 'admin.regions.create',
        'store' => 'admin.regions.store',
        'edit' => 'admin.regions.edit',
        'update' => 'admin.regions.update',
        'destroy' => 'admin.regions.delete',
    ]);

    //Category
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.delete',
    ]);

    //Big-Category
    Route::resource('big_categories', BigCategoryController::class)->names([
        'index' => 'admin.big_categories.index',
        'create' => 'admin.big_categories.create',
        'store' => 'admin.big_categories.store',
        'edit' => 'admin.big_categories.edit',
        'update' => 'admin.big_categories.update',
        'destroy' => 'admin.big_categories.delete',
    ]);
});
