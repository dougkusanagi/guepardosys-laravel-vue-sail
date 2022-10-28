<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Enums\ProductStatusEnum;
use App\Models\ProductModelPrefix;
use App\Services\ProductImageService;
use App\Services\ProductModelService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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
		ProductModelService::register($request, $product);
		ProductImageService::create($request, $product);

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
	 * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function show(Product $product)
	{
		return inertia();
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
			'images' => getProductImagesPublicPaths($product),
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
		ProductModelService::update($request, $product);
		ProductImageService::create($request, $product);

		Session::flash('success', [
			'title' => 'Parabéns!',
			'message' => 'Produto atualizado com sucesso',
		]);

		return redirect()->route('product.edit', ['product' => $product->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Product $product)
	{
		$product->delete();

		return back()->with('success', [
			'title' => 'Parabéns!',
			'message' => 'Produto removido com sucesso',
		]);
	}
}
