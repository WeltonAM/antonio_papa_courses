<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\ScopeAdminMiddleware;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum', ScopeAdminMiddleware::class)->group(function () {
        // AUTH
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('users/info', [AuthController::class, 'updateInfo'])->name('users.info');
        Route::post('users/password', [AuthController::class, 'updatePassword'])->name('users.password') ;

        // USERS
        Route::get('ambassadors', [AmbassadorController::class, 'index'])->name('ambassadors');
        Route::get('user', [AuthController::class, 'user']);

        // PRODUCTS
        Route::get('products', [ProductController::class, 'index'])->name('products');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});
