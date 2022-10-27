<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RahulHaque\Filepond\Facades\Filepond;

class ProductImageService
{
	public static function create(Request $request, Product $product)
	{
		$images = getProductImagesAll($product);
		$count_images = count($images);

		foreach ($request->filepond_files as $key => $value) {
			Filepond::field($value)
				->moveTo(env('PRODUCT_IMAGES_ROOT') . DS . $product->id . DS . $key + $count_images);
		}
	}

	public static function delete(Request $request)
	{
		$array_dir = explode("/", $request->image);
		unset($array_dir[0]);
		unset($array_dir[1]);
		$image_dir = implode("/", $array_dir);

		Storage::disk(config('filepond.disk', 'public'))->delete($image_dir);
	}
}
