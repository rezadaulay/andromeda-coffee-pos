<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\LogoutController;
use App\Http\Controllers\Dashboard\ProductCategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\PaymentMethodController;
use App\Http\Controllers\Dashboard\ManagementStockController;
use App\Http\Controllers\Dashboard\SellingController;
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
    
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);

    Route::resource('payment-methods',PaymentMethodController::class);
    Route::resource('management-stock',ManagementStockController::class);


    // Route::get('/users', IndexController::class)->name('dashboard.index');
    // Route::get('/sales', IndexController::class)->name('dashboard.index');

    // Selling (kasir)
    Route::resource('selling', SellingController::class);
    Route::get('/selling-history', [SellingController::class, 'history'])->name('selling.history');
    Route::get('selling/{sale}/detail', [SellingController::class, 'detail'])->name('selling.detail');

    // Payment Method
}); // https://laravel.com/docs/12.x/middleware
