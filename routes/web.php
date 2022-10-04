<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
// Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::get('/products', function () {
    $products = Product::query()
        ->select('name', 'status')
        ->when(request('search'), fn ($q, $search) => $q->where('name', 'LIKE', $search . '%'))
        ->when(request('status'), fn ($q, $status)  => $q->where('status', $status))
        ->when(request('orderByField'), fn ($q, $field) => $q->orderBy($field, request('direction')))
        ->orderBy('name', 'ASC')
        ->paginate();

    $countProducts = Product::toBase()
        ->selectRaw("count(IF(status = 'active', 1, null)) as totalActive")
        ->selectRaw("count(IF(status = 'inactive', 1, null)) as totalInactive")
        ->selectRaw("count(IF(status = 'waiting', 1, null)) as totalWaiting")
        ->selectRaw("count(*) as total")
        ->get();

    return inertia('Product/Index', compact([
        'products',
        'countProducts',
    ]));
})->name('product.index');
Route::get('/products/add', fn () => inertia('Product/Add'))->name('product.add');

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
