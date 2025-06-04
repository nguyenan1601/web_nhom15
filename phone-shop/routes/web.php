<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/check-url', function () {
    return config('app.url');
});


Route::get('/', [HomeController::class, 'index']);