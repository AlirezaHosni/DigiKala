<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValueRequest extends FormRequest
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
            'value' => 'required|max:120|min:1|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'price_increase' => 'required|numeric',
            'product_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:products,id',
            'type' => 'required|numeric|in:0,1',
        ];
    }
}
