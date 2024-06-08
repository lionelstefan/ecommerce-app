<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', function() {
    return redirect('welcome');
});

Route::get('/welcome', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'list'])->name('products');
    Route::get('/products/add', function() {
        return view('products.add');
    })->name('products.add');
    Route::post('/products/add', [ProductController::class, 'save'])->name('products.save');

    Route::get('/cart', [CartController::class, 'list'])->name('cart');

    Route::get('/orders', [OrderController::class, 'list'])->name('orders');
    Route::post('/orders', [OrderController::class, 'make'])->name('orders.make');
});

require __DIR__.'/auth.php';
