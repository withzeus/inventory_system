<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/products/select', [ProductController::class, 'select'])->name('products.select');
    Route::apiResource('products', ProductController::class);

    Route::apiResource('orders', OrderController::class);
});
