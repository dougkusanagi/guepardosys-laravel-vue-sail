<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
//Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.add');

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
