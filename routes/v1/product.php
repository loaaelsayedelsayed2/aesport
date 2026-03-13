<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/product')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('/types', [TypeController::class, 'list']);
        Route::get('/types-categories', [TypeController::class, 'listWithCategories']);
        Route::get('/categories', [CategoryController::class, 'list']);
        Route::get('/sports', [SportController::class, 'list']);
        Route::get('/brands', [BrandController::class, 'list']);
        Route::get('/list', [ProductController::class, 'list']);
        Route::get('/details/{id}', [ProductController::class, 'details']);
        Route::post('/add-favorites', [ProductController::class, 'addFavorites']);
        Route::post('/add-review', [ProductController::class, 'addReview']);
    });
});
