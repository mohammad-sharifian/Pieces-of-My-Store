<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttrtypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin-panel/dashboard')->name('dashboard');

Route::prefix('admin-panel/management')->name('admin.')
    ->group(function(){
        Route::resource('brands', BrandController::class);
        Route::resource('attrtypes', AttrtypeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('products', ProductController::class);
        Route::resource('banners', BannerController::class);

        Route::get('category-attrtypes/{category}', [CategoryController::class, 'getCategoryAttrtypes']);
        Route::get('category-products/{category}', [CategoryController::class, 'getCategoryProducts'])->name('getCategoryProducts');

        //  Edit Images Product
        Route::get('products/{product}/images-edit', [ProductImageController::class, 'edit'])->name('products.images.edit');
        Route::put('products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.setPrimary');
        Route::delete('products/{product}/images-delete', [ProductImageController::class, 'delete'])->name('products.images.delete');
        Route::post('products/{product}/images-restore', [ProductImageController::class, 'restore'])->name('products.images.restore');
        Route::delete('products/{product}/images-force-delete', [ProductImageController::class, 'forceDelete'])->name('products.images.forceDelete');
        Route::post('products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');

        // Edit Category Product
        Route::get('products/{product}/category-edit', [ProductController::class, 'editCategory'])->name('products.category.edit');
        Route::put('products/{product}/category-update', [ProductController::class, 'updateCategory'])->name('products.category.update');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');

