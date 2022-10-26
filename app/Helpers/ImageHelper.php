<?php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getProductImages')) {
	function getProductImagePaths(Product $product, $disk = 'public')
	{
		return Storage::disk($disk)->files(env('PRODUCT_IMAGES_ROOT') . '/' . $product->id);
	}

	function getProductImagePublicPaths(Product $product, $disk = 'public')
	{
		return array_map(function ($image) {
			return '/storage/' . $image;
		}, getProductImagePaths($product, $disk));
	}
}
