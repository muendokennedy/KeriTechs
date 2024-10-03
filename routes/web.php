<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CustomerController;

Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
Route::get('/about', [CustomerController::class, 'about'])->name('customer.about');
Route::get('/products', [CustomerController::class, 'products'])->name('customer.products');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customer.contact');
Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
Route::get('/productpage', [CustomerController::class, 'productpage'])->name('customer.productpage');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
