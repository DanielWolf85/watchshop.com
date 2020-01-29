<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string|min:1|max:50|',
            'category_id'  => 'required|integer',
            'brand_id'     => 'required|integer',
            'price'        => 'required|float|min:0|max:1000000',
            'color_id'     => 'required|integer',
            'size_id'      => 'required|integer',
            'description'  => 'string|max:500|min:3',
        ];
    }
}
