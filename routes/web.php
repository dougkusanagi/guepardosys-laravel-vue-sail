<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;

// Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::resource('/product', ProductController::class);

Route::delete('/delete-image/{product}', [ProductImageController::class, 'deleteImage'])->name('image.delete');

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
require app_path() . '/constants.php';
