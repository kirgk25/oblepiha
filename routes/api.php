<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/token', 'token');

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/token', 'destroyToken');
        Route::delete('/tokens', 'destroyTokens');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', ProductController::class)->only([
        'index',
        'show',
        'store',
        'update',
    ]);
});


