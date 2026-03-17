<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/cart')->middleware('auth:api')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::get('/show', [CartController::class, 'showCart']);
    Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::post('/change-quantity/{id}', [CartController::class, 'changeQuantity']);
});
