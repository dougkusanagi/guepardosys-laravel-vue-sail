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

	public static function delete(Request $request)
	{
		$array_dir = explode("/", $request->image);
		unset($array_dir[0]);
		unset($array_dir[1]);
		$image_dir = implode("/", $array_dir);

		Storage::disk(config('filepond.disk', 'public'))->delete($image_dir);
	}

	private static function renameAllImagesAsTemp(Product $product)
	{
		foreach (getProductImagesAll($product) as $image) {
			[
				'basename' => $basename,
				'dirname' => $dirname
			] = pathinfo($image);
			$i = 0;
			while (is_file($temp_name = $dirname . DS . "temp{$i}-{$basename}")) $i++;
			rename($image, $temp_name);
		}
	}

	public static function sortAscending(Product $product)
	{
		self::renameAllImagesAsTemp($product);

		foreach (getProductImagesAll($product) as $index => $image) {
			['extension' => $extension, 'dirname' => $dirname] = pathinfo($image);
			rename($image, $dirname . DS . "{$index}.{$extension}");
		}
	}
}
