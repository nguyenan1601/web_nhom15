<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tìm kiếm
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Sản phẩm
Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');
Route::get('/phones/{phone}', [PhoneController::class, 'show'])->name('phones.show');

// Thương hiệu
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');

// Danh mục
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Các trang khác
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

Route::resource('orders', OrderController::class)->only([
    'index', 'show', 'destroy'
]);

Route::get('/check-url', function () {
    return config('app.url');
});