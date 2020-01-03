<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 27.03.2018
 * Time: 11:15
 */

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;


class CompanyCreateRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:100',
            'logo_url' => 'required|mimes:jpeg,bmp,png,jpg',
            'city_id' => 'required',
            'industry_id' => 'required',
            'address'  => 'required|string|min:2|max:255',
            'postal_code'   => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Company Name field is required',
            'logo_url.required' => 'Please select your logo',
            'city_id.required' => 'City field is required',
            'industry_id.required' => 'Industry field is required',
            'address.required' => 'Address field is required',
            'postal_code.required' => 'Zip code field is required',
        ];
    }
}