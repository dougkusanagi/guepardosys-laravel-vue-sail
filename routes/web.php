<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::controller(ProductController::class)->group(function () {
	Route::get('/product', 'index')->name('product.index');
	Route::get('/product/create', 'create')->name('product.create');
	Route::post('/product/store', 'store')->name('product.store');
});

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
