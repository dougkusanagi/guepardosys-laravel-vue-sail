<?php

use Illuminate\Support\Facades\Route;
use App\Enums\ProductStatusEnum;
use App\Models\ProductModelPrefix;
use App\Models\Category;
use App\Models\Product;

 Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
//Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::get('/products', function () {
	$products = Product::query()
		->with('category')
		->when(request('category'), fn ($query, $category_id)  => $query->where('category_id', $category_id))
		->when(request('order_by'), fn ($query, $field) => $query->orderBy($field, request('direction')))
		->when(request('status') !== null,  fn ($query) => $query->status())
		->when(request('search'), fn ($query) => $query->search())
		->paginate(5);

	$products_count = Product::getStatusCounts();

	$categories_all = Category::all();

	$product_status_all = [];
	foreach (ProductStatusEnum::asArray() as $index => $status) {
		$product_status_all[$index] = (string) $status;
	}
	$product_status_all = collect($product_status_all);

	return inertia('Product/Index', compact([
		'products', 'products_count', 'categories_all', 'product_status_all'
	]));
})->name('product.index');
Route::get('/products/add', function () {
	$product_model_prefixes = ProductModelPrefix::all();

	$product_status_enum = collect(ProductStatusEnum::asSelectArray())
		->map(fn ($status, $index) => ['id' => $index, 'name' => $status]);

	return inertia('Product/Add', compact('product_model_prefixes', 'product_status_enum'));
})->name('product.add');

Route::get('/categories', fn () => inertia('Category/Index'))->name('category.index');

require __DIR__ . '/auth.php';
