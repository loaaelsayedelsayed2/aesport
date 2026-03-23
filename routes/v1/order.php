<?php


use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/order')->middleware('auth:api')->group(function () {
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/details/{id}', [OrderController::class, 'details']);
    Route::get('/cancel/{id}', [OrderController::class, 'cancel']);
});
