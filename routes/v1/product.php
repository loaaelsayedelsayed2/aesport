<?php

use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/product')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/types', [TypeController::class, 'list']);
    });
});
