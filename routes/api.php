<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__.'/v1/auth.php';
require __DIR__.'/v1/product.php';
require __DIR__.'/v1/cart.php';
require __DIR__.'/v1/order.php';
