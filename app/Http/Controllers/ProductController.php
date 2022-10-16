<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductModelPrefix;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$per_page = request('per_page') ?? "25";

		return inertia('Product/Index', [
			'product_pages' =>
				Product::with('category')
					->filter()
					->paginate($per_page)
					->withQueryString(),
			'product_status_array' => ProductStatusEnum::asSelectArray(),
			'product_status_all' => $this->getProductStatusAll(),
			'products_count' => Product::getStatusCounts(),
			'categories_all' => Category::all(),
			'per_page' => $per_page,
		]);
	}

	public function getProductStatusAll()
	{
		$product_status_all = [];
		foreach (ProductStatusEnum::asArray() as $index => $status) {
			$product_status_all[$index] = (string) $status;
		}

		return collect($product_status_all);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$product_model_prefixes = ProductModelPrefix::all();

		$product_status_enum = collect(ProductStatusEnum::asSelectArray())
			->map(fn ($status, $index) => ['id' => $index, 'name' => $status]);

		return inertia('Product/Create', compact([
			'product_model_prefixes', 'product_status_enum'
		]));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductRequest $request)
	{
		dd($request->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateProductRequest  $request
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateProductRequest $request, Product $product)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		//
	}
}
