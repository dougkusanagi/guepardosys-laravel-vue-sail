<?php

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductModelPrefix;
use Illuminate\Support\Facades\Route;

 Route::get('/', fn () => inertia('Dashboard'))->name('dashboard');
//Route::get('/', fn () => redirect()->route('product.index'))->name('dashboard');

Route::get('/products', function () {
	$products = Product::query()
		// ->select('name', 'status')
		->with('category')
		->when(request('search'), fn ($q, $search) => $q->where('name', 'LIKE', $search . '%'))
		->when(request('status'), fn ($q, $status)  => $q->where('status', $status))
		->when(request('category'), fn ($q, $category_id)  => $q->where('category_id', $category_id))
		->when(request('order_by_field'), fn ($q, $field) => $q->orderBy($field, request('direction')))
		->orderBy('name', 'ASC')
		->paginate();

	$products_count = Product::toBase()
		->selectRaw("count(IF(status = ".ProductStatusEnum::Active.", 1, null)) as totalActive")
		->selectRaw("count(IF(status = ".ProductStatusEnum::Inactive.", 1, null)) as totalInactive")
		->selectRaw("count(IF(status = ".ProductStatusEnum::Waiting.", 1, null)) as totalWaiting")
		->selectRaw("count(*) as total")
		->first();

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
