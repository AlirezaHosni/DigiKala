<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST'))
        {
            return [
                'first_name' => 'required|max:120|min:2|regex:/^[a-zA-Zء-ي ا-ی]+$/u',
                'last_name' => 'required|max:120|min:2|regex:/^[a-zA-Zء-ي ا-ی]+$/u',
                'mobile' => 'required|digits:11|unique:users',
                'email' => 'required|string|email|unique:users',
                'password' => ['required', 'unique:users', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        }else
        {
            return [
                'first_name' => 'required|max:120|min:2|regex:/^[a-zA-Zء-ي ا-ی]+$/u',
                'last_name' => 'required|max:120|min:2|regex:/^[a-zA-Zء-ي ا-ی]+$/u',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
