<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
		return [
			'category_id' => 'nullable',
			'name' => 'required',
			'slug' => 'required',
			'price' => 'required',
			'description' => 'nullable',
			'description_html' => 'nullable',
			'stock_local' => 'nullable',
			'stock_local_min' => 'nullable',
			'stock_virtual' => 'nullable',
			'barcode' => 'nullable',
			'ncm' => 'nullable',
			'weight' => 'nullable',
			'height' => 'nullable',
			'width' => 'nullable',
			'length' => 'nullable',
			'availability' => 'nullable',
			'keywords' => 'nullable',
			'status' => 'nullable',
			'brand' => 'nullable',
		];
    }
}
