<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authorization
Route::controller(UserController::class)
    ->group(function () {
        Route::post('/login', 'login')->name('users.login');
        Route::post('/token', 'token')->name('users.token');
    });

// Tokens
Route::middleware('auth:sanctum')
    ->controller(UserController::class)
    ->group(function () {
        Route::delete('/token', 'destroyToken')->name('users.token.destroy');
        Route::delete('/tokens', 'destroyTokens')->name('users.token.destroy.all');
    });
