<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => 'required|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            'body' => 'required|max:600|min:5|regex:/^[a-zA-Z\-۰-۹0-9ء-ي.ا-ی><\/&;\n\r ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required|regex:/^[a-zA-Z\-۰-۹0-9,ء-ي. ا-ی]+$/u',
        ];
    }
}
