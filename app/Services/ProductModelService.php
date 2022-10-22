<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductModelPrefix;

class ProductModelService
{
	public static function register(Product $product)
	{
		$prefix_id = request('product_model_prefix_id');
		$product_model_prefix = ProductModelPrefix::findOrFail($prefix_id);

		$digits = request('product_model_digits') ??
			ProductModel::getNextProductModelDigit($product_model_prefix);

		ProductModel::create([
			'product_id' => $product->id,
			'product_model_prefix_id' => $prefix_id,
			'digits' => $digits,
		]);
	}

	public static function update(Product $product)
	{
		$product->productModel()->delete();

		self::register($product);
	}
}
