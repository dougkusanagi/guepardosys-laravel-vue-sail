<?php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getProductImagePaths')) {
	function getProductImagePaths(Product $product, $disk = 'public')
	{
		return Storage::disk($disk)->files(env('PRODUCT_IMAGES_ROOT') . DS . $product->id);
	}
}

if (!function_exists('getProductImagesPublicPaths')) {
	function getProductImagesPublicPaths(Product $product, $disk = 'public')
	{
		return array_map(function ($image) {
			return '/storage/' . $image;
		}, getProductImagePaths($product, $disk));
	}
}

if (!function_exists('getProductImagesPath')) {
	function getProductImagesPath(Product $product)
	{
		return public_path('storage' . DS . env('PRODUCT_IMAGES_ROOT') . DS . $product->id);
	}
}
if (!function_exists('getProductImagesAll')) {
	/**
	 * Get an array of absolute paths to product images files
	 * @param Product $product
	 */
	function getProductImagesAll(Product $product): Array
	{
		return glob(getProductImagesPath($product) . DS . '*.' . env('PRODUCT_IMAGE_EXTENSIONS'), GLOB_BRACE);
	}
}
