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
		$count_images = count(getProductImagesAll($product));

		foreach ($request->filepond_files as $index => $value) {
			Filepond::field($value)
				->moveTo(env('PRODUCT_IMAGES_ROOT') . DS . $product->id . DS . $index + $count_images);
		}
	}

	public static function removeParameters($image) {
		return parse_url($image)['path'];
	}

	private static function removeStorageFromPath(String $image_public_path): String
	{
		$array_dir = explode('/', $image_public_path);
		unset($array_dir[0]);
		unset($array_dir[1]);
		return implode('/', $array_dir);
	}

	public static function delete(Request $request)
	{
		$image_dir = self::removeStorageFromPath($request->image);
		$clean_path = self::removeParameters($image_dir);
		Storage::disk(config('filepond.disk', 'public'))->delete($clean_path);
	}

	public static function renameAscending(Product $product)
	{
		$image_list = collect(getProductImagesAll($product));
		$image_list
			->sort()				// sort ascending by filename
			->values()			// reindex for renaming files again 0.jpg, 1.png, etc...
			->each(function ($image, $index) {
				['dirname' => $dirname, 'extension' => $extension] = pathinfo($image);
				rename($image, $dirname . DS . "{$index}.{$extension}");
			});
	}
}
