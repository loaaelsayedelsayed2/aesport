<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
