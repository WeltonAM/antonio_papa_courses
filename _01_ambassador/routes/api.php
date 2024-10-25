<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\ScopeAdminMiddleware;
use App\Http\Middleware\ScopeAmbassadorMiddleware;
use Illuminate\Support\Facades\Route;

function common($scopeMiddleware)
{
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum',
        $scopeMiddleware === 'admin' ? ScopeAdminMiddleware::class : ScopeAmbassadorMiddleware::class
    ])->group(function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('users/info', [AuthController::class, 'updateInfo'])->name('users.info');
        Route::post('users/password', [AuthController::class, 'updatePassword'])->name('users.password');
    });
}

// ADMIN routes
Route::prefix('admin')->group(function () {
    common('admin');

    Route::middleware(['auth:sanctum', ScopeAdminMiddleware::class])->group(function () {
        Route::get('ambassadors', [AmbassadorController::class, 'index'])->name('ambassadors');
        Route::apiResource('products', ProductController::class);
        Route::get('users/{id}/links', [LinkController::class, 'index'])->name('links.index');
        Route::get('orders', [OrderController::class, 'index'])->name('orders');
    });
});

// AMBASSADOR routes
Route::prefix('ambassador')->group(function () {
    common('ambassador');
});
