<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\LogoutController;
use App\Http\Controllers\Dashboard\ProductCategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;


// guest: jika belum login maka otomatis laravel redirect ke route dashboard
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'post'])->name('login.post');

// tanpa middleware => Browser akses -> Dashboard
// dengan middleware => Browser akses -> middleware (auth) -> Dashboard
// auth: jika belum login maka otomatis laravel mencari route dengna name = login
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', IndexController::class)->name('dashboard.index');
    Route::get('/logout', LogoutController::class)->name('dashboard.logout');
    
    Route::get('/product-category/detail/{id}', [ProductCategoryController::class, "show"]);
    Route::get('/product-category/delete/{id}', [ProductCategoryController::class, "destroy"])->name('product-category.delete');
    Route::resource('product-categories', ProductCategoryController::class);
    // Products resource (for proper delete) and debug routes
    Route::resource('products', ProductController::class)->only(['destroy']);

    // Debug routes: temporary product list and delete for testing
    Route::get('/debug/products', [ProductController::class, 'index'])->name('debug.products');

    Route::get('/debug/product/delete/{id}', [ProductController::class, 'destroy'])->name('debug.product.delete');
    // Route::get('/users', IndexController::class)->name('dashboard.index');
    // Route::get('/sales', IndexController::class)->name('dashboard.index');
}); // https://laravel.com/docs/12.x/middleware


// Route::get('/', function () {
//     return view('welcome');
// });
