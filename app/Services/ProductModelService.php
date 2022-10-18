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
		$next_model_digit = ProductModel::getNextProductModelDigit($product_model_prefix);

		ProductModel::create([
			'product_id' => $product->id,
			'product_model_prefix_id' => $prefix_id,
			'digits' => $next_model_digit,
		]);
	}
}
