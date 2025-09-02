<?php

declare(strict_types=1);

use App\Http\Controllers\Product\FavouriteController;
use Illuminate\Support\Facades\Route;

Route::controller(FavouriteController::class)
    ->group(function () {
        Route::post('products/{product}/favourite', 'store')->name('products.favourite.store');
        Route::delete('products/{product}/favourite', 'destroy')->name('products.favourite.destroy');
    });
