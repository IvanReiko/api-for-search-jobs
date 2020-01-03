<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array,
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'last_name'  => 'required|string|min:2|max:100',
            'position'   => 'max:100',
            'photo_url' => 'mimes:jpeg,bmp,png,jpg'
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'First name field is required',
            'last_name.required' => 'Last name field is required',
            'position' => 'Position field',
            'photo_url' => 'Photo field',

        ];
    }
}
