<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/page')->group(function () {
    Route::get('/info-site', [PagesController::class, 'showInfo']);
    Route::get('/home', [PagesController::class, 'home']);
    Route::get('/banners', [PagesController::class, 'getBanners']);

});
