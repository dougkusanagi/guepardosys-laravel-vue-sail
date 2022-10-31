<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductImageService;
use Illuminate\Support\Facades\Session;

class ProductImageController extends Controller
{
	public function deleteImage(Request $request, Product $product)
	{
		ProductImageService::delete($request);
		ProductImageService::sortAscending($product);

		Session::flash('alert', [
			'type' => 'success',
			'message' => 'Imagem deletada com sucesso',
		]);

		redirect()->route('product.edit', $product->id);
	}
}
