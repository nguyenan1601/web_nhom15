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

// Import CartController
use App\Http\Controllers\CartController;

// Include Authentication Routes
require __DIR__.'/auth.php';

// Thanh toán - cho phép cả guest và auth user
use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Protected Routes (cần đăng nhập)
Route::middleware('auth')->group(function () {
    // Giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Đơn hàng
    Route::resource('orders', OrderController::class)->only([
        'index', 'show', 'destroy'
    ]);
    
    // Checkout success và show (cần đăng nhập)
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/order/{order}', [CheckoutController::class, 'show'])->name('checkout.show');
});

Route::get('/check-url', function () {
    return config('app.url');
});