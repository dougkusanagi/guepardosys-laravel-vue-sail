<?php

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
// Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::get('/products', function () {
    $products = Product::query()
        // ->select('name', 'status')
        ->with('category')
        ->when(request('search'), fn ($q, $search) => $q->where('name', 'LIKE', $search . '%'))
        ->when(request('status'), fn ($q, $status)  => $q->where('status', $status))
        ->when(request('category'), fn ($q, $category_id)  => $q->where('category_id', $category_id))
        ->when(request('orderByField'), fn ($q, $field) => $q->orderBy($field, request('direction')))
        ->orderBy('name', 'ASC')
        ->paginate();

    $countProducts = Product::toBase()
        ->selectRaw("count(IF(status = 'active', 1, null)) as totalActive")
        ->selectRaw("count(IF(status = 'inactive', 1, null)) as totalInactive")
        ->selectRaw("count(IF(status = 'waiting', 1, null)) as totalWaiting")
        ->selectRaw("count(*) as total")
        ->get();
    
    $categoriesAll = Category::all();

    return inertia('Product/Index', compact([
        'products',
        'countProducts',
        'categoriesAll'
    ]));
})->name('product.index');
Route::get('/products/add', function () {
    return inertia('Product/Add', [
        'product_status_enum' => ProductStatusEnum::asArray()
    ]);
})->name('product.add');

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
