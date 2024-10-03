<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
Route::get('/about', [CustomerController::class, 'about'])->name('customer.about');
Route::get('/products', [CustomerController::class, 'products'])->name('customer.products');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customer.contact');
Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::get('/productpage', [CustomerController::class, 'productpage'])->name('customer.productpage');

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'adminHome'])->name('admin.dashboard');
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
