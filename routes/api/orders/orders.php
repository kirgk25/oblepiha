<?php

declare(strict_types=1);

use App\Http\Controllers\Orders\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)
    ->group(function () {
        Route::get('orders', 'index')->name('orders.index');
        Route::post('orders', 'store')->name('orders.store');
        Route::post('orders/consume', 'consumeStore')->name('orders.consume');
    });
