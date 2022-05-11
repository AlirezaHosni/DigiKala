<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'question' => 'required|max:500|min:5|regex:/^[a-zA-Z\-۰-۹0-9ء-ي.ا-ی><\/&;\n\r؟?! ]+$/u',
            'answer' => 'required|max:500|min:5|regex:/^[a-zA-Z\-۰-۹0-9ء-ي.ا-ی><\/&;\n\r؟?! ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
        ];

    }
}
