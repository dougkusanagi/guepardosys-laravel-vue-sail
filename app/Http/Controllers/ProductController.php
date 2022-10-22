<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductModelPrefix;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductModelService;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
     * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function index()
	{
		return inertia('Product/Index', [
			'product_pages' =>
				Product::query()
					->with('category')
					->filter()
					->paginate(request('per_page'))
					->withQueryString(),
			'product_status_array' => ProductStatusEnum::asSelectArray(),
			'product_status_all' => $this->getProductStatusAll(),
			'products_count' => Product::getStatusCounts(),
			'categories_all' => Category::all(),
			'per_page' => request('per_page', (new Product)->perPage),
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
     * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function create()
	{
		return inertia('Product/Create', [
			'product_model_prefixes' => ProductModelPrefix::all(),
			'product_status_enum' => collect(ProductStatusEnum::asSelectArray())
				->map(fn ($status, $index) => ['id' => $index, 'name' => $status]),
			'categories_all' => Category::all(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreProductRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreProductRequest $request)
	{
		$product = Product::create($request->validated());

		ProductModelService::register($product);

		return redirect()
			->route('product.index')
			->with('success', [
				'title' => 'Parabéns!',
				'message' => 'Produto cadastrado com sucesso',
			]);
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
	 * @param  \App\Models\Product  $product
     * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function edit(Product $product)
	{
		return inertia('Product/Edit', [
			'product' => $product,
			'product_model_prefixes' => ProductModelPrefix::all(),
			'product_status_enum' => collect(ProductStatusEnum::asSelectArray())
				->map(fn ($status, $index) => ['id' => $index, 'name' => $status]),
			'categories_all' => Category::all(),
		]);
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
		$product->update($request->validated());

		ProductModelService::update($product);

		return redirect()
			->route('product.index')
			->with('success', [
				'title' => 'Parabéns!',
				'message' => 'Produto atualizado com sucesso',
			]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		// dd($product->id);

		$product->delete();

		return back()->with('success', [
			'title' => 'Parabéns!',
			'message' => 'Produto removido com sucesso',
		]);
	}
}
