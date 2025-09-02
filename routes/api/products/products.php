<?php

declare(strict_types=1);

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)
    ->group(function () {
        Route::get('products', 'index')->name('products.index');
        Route::post('products', 'store')->name('products.store');
        Route::get('products/{product}', 'show')->name('products.show');
        Route::patch('products/{product}', 'update')->name('products.update');
    });
