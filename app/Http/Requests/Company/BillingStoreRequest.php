<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 27.03.2018
 * Time: 11:15
 */

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;


class BillingStoreRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required',
            'company_name' => 'required',
            'vat'   => 'required',
            'address'  => 'required|string|min:2|max:255',
            'postal_code'   => 'required',
            'city_id'   => 'required',
            'email'   => 'required',
        ];
    }
}