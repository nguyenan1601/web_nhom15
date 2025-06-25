<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
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

// Routes cho khách hàng quản lý đơn hàng
Route::middleware('auth')->group(function () {
    Route::prefix('my')->group(function () {
        Route::get('/orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
        Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
        Route::patch('/orders/{order}/confirm-received', [CustomerOrderController::class, 'confirmReceived'])->name('customer.orders.confirm-received');
        Route::patch('/orders/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('customer.orders.cancel');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Quản lý người dùng (admin)
    Route::prefix('admin')->group(function () {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
    });
    
    // Quản lý sản phẩm (admin)
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::get('/phones', [\App\Http\Controllers\PhoneController::class, 'adminIndex'])->name('admin.phones.index');
        Route::get('/phones/create', [\App\Http\Controllers\PhoneController::class, 'create'])->name('admin.phones.create');
        Route::post('/phones', [\App\Http\Controllers\PhoneController::class, 'store'])->name('admin.phones.store');
        Route::get('/phones/{phone}/edit', [\App\Http\Controllers\PhoneController::class, 'edit'])->name('admin.phones.edit');
        Route::put('/phones/{phone}', [\App\Http\Controllers\PhoneController::class, 'update'])->name('admin.phones.update');
        Route::delete('/phones/{phone}', [\App\Http\Controllers\PhoneController::class, 'destroy'])->name('admin.phones.destroy');
    });
    
    // Quản lý đơn hàng (admin)
    Route::prefix('admin')->group(function () {
        Route::get('/orders', [OrderManagementController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('admin.orders.show');
        Route::patch('/orders/{order}/confirm', [OrderManagementController::class, 'confirm'])->name('admin.orders.confirm');
        Route::patch('/orders/{order}/process', [OrderManagementController::class, 'process'])->name('admin.orders.process');
        Route::patch('/orders/{order}/ship', [OrderManagementController::class, 'ship'])->name('admin.orders.ship');
        Route::patch('/orders/{order}/mark-delivered', [OrderManagementController::class, 'markDelivered'])->name('admin.orders.mark-delivered');
        Route::patch('/orders/{order}/cancel', [OrderManagementController::class, 'cancel'])->name('admin.orders.cancel');
    });
});

Route::get('/check-url', function () {
    return config('app.url');
});
