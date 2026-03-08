<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/product')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/types', [TypeController::class, 'list']);
        Route::get('/types-categories', [TypeController::class, 'listWithCategories']);
        Route::get('/categories', [CategoryController::class, 'list']);
    });
});
