<?php

namespace App\Http\Requests\Api\Candidate\Filter;

use Illuminate\Foundation\Http\FormRequest;

class GeneralStoreRequest extends FormRequest
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
            'employment_levels'    => 'present|array',
            'employment_levels.*'  => 'nullable|integer|distinct|min:1',
            'employment_types'     => 'nullable|array',
            'employment_types.*'   => 'nullable|integer|distinct|min:1',
            'salary_min'           => 'nullable|integer|between:0,5000',
            'salary_max'           => 'nullable|integer|between:'.request()->salary_min.',5000',
            'experience_years_min' => 'nullable|integer|between:0,50',
            'experience_years_max' => 'nullable|integer|between:'.request()->experience_years_min.',50',
        ];
    }
}
