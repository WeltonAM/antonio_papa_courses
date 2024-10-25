<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatsController;
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
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('users/info', [AuthController::class, 'updateInfo']);
        Route::post('users/password', [AuthController::class, 'updatePassword']);
    });
}

// ADMIN routes
Route::prefix('admin')->group(function () {
    common('admin');

    Route::middleware(['auth:sanctum', ScopeAdminMiddleware::class])->group(function () {
        Route::get('ambassadors', [AmbassadorController::class, 'index']);
        Route::apiResource('products', ProductController::class);
        Route::get('users/{id}/links', [LinkController::class, 'index']);
        Route::get('orders', [OrderController::class, 'index']);
    });
});

// AMBASSADOR routes
Route::prefix('ambassador')->group(function () {
    common('ambassador');

    Route::get('products/frontend', [ProductController::class, 'frontend']);
    Route::get('products/backend', [ProductController::class, 'backend']);

    Route::middleware(['auth:sanctum', ScopeAmbassadorMiddleware::class])->group(function () {
        Route::get('stats', [StatsController::class, 'index']);
        Route::get('rankings', [StatsController::class, 'rankings']);

        Route::post('links', [LinkController::class, 'store']);
    });
});

//CHECKOUT
Route::prefix('checkout')->group(function () {
    Route::get('links/{code}', [LinkController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
});
