<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ScopeAdminMiddleware;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum', ScopeAdminMiddleware::class)->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('users/info', [AuthController::class, 'updateInfo'])->name('users.info');
        Route::post('users/password', [AuthController::class, 'updatePassword'])->name('users.password') ;

        Route::get('ambassadors', [AmbassadorController::class, 'index'])->name('ambassadors');
        Route::get('user', [AuthController::class, 'user']);
    });
});
