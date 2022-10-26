<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use RahulHaque\Filepond\Facades\Filepond;

class ProductImageService
{
	public static function create(Request $request, Product $product)
	{
		foreach ($request->filepond_files as $key => $value) {
			Filepond::field($value)
				->moveTo(env('PRODUCT_IMAGES_ROOT') . '/' . $product->id . '/' . $key);
		}
	}
}
