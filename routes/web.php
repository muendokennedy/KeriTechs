<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

Route::middleware('prevent.back.history')->group(function(){

    Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
    Route::get('/about', [CustomerController::class, 'about'])->name('customer.about');
    Route::get('/products', [CustomerController::class, 'products'])->name('customer.products');
    Route::get('/contact', [CustomerController::class, 'contact'])->name('customer.contact');
    Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    Route::get('/productpage', [CustomerController::class, 'productpage'])->name('customer.productpage');

    require __DIR__ . '/adminauth.php';


    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
        Route::get('/dashboard', [AdminController::class, 'adminHome'])->name('admin.dashboard');
        Route::get('/analytics', [AdminController::class, 'adminAnalytics'])->name('admin.analytics');
        Route::get('/products', [AdminController::class, 'adminProducts'])->name('admin.products');
        Route::get('/orders', [AdminController::class, 'adminOrders'])->name('admin.orders');
        Route::get('/stock', [AdminController::class, 'adminStock'])->name('admin.stock');
        Route::get('/clientinfo', [AdminController::class, 'adminClientinfo'])->name('admin.clientinfo');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        // Admin auth routes

        Route::post('/product/store', [AdminProductController::class, 'storeProduct'])->name('admin.product.store');
        Route::put('/product/update/{product}', [AdminProductController::class, 'updateProduct'])->name('admin.product.update');
        Route::delete('/product/delete/{product}', [AdminProductController::class, 'deleteProduct'])->name('admin.product.delete');
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

