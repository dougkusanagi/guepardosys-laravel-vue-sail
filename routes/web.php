<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FilepondController;

// Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::resource('/product', ProductController::class);

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

// Route::post('/upload-temporary-file', [FilepondController::class, 'uploadTemporaryFile'])
// 	->name('file.uploadTemporaryFile');
// Route::delete('/delete-temporary-file', [FilepondController::class, 'deleteTemporaryFile'])
// 	->name('file.deleteTemporaryFile');

require __DIR__ . '/auth.php';
