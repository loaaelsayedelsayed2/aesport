<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/forget-password', [UserController::class, 'forgetPassword'])->middleware('throttle:3,10'); // Limit to 3 requests per 10 minute
    Route::post('/verfication-otp', [UserController::class, 'verificationOtp']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/show-profile', [UserController::class, 'showProfile']);
        Route::post('/edit-profile', [UserController::class, 'editProfile']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
    });
    // google auth routes
    Route::post('/google', [GoogleAuthController::class, 'loginWithGoogle']);
});
