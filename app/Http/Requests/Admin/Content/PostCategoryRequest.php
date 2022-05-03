<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'name' => 'required|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
                'description' => 'required|max:500|min:5|regex:/^[a-zA-Z\-۰-۹0-9ء-ي.ا-ی><\/&;\n\r ]+$/u',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            ];
        }
        else {
            return [
                'name' => 'required|max:120|min:2|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
                'description' => 'required|max:500|min:5|regex:/^[a-zA-Z\-۰-۹0-9ء-ي.ا-ی><\/&;\n\r ]+$/u',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[a-zA-Z\-۰-۹0-9ء-ي. ا-ی]+$/u',
            ];
        }
    }

//    public function attributes()
//    {
//        return [
//            'name' => 'نام دسته‌بندی',
//            'description' => 'توضیحات',
//            'image' => 'تصویر',
//            'status' => 'وضعیت',
//            'tags' => 'تگ‌ها',
//        ];
//    }
}
