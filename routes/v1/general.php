<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/page')->group(function () {
    Route::get('/home', [PagesController::class, 'home']);

});
