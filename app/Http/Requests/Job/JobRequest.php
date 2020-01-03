<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;


class JobRequest extends FormRequest
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
            'company_name' => 'required|string|min:2|max:100',
            'city_id' => 'required',
            'job_role_id' => 'required',
            'industry_id' => 'required',
            'experience_years_min' => 'required',
            'experience_years_max' => 'required',
            'salary_min' => 'required',
            'salary_max' => 'required',
            'skills' => 'required',
            'languages' => 'required',
            'address'  => 'required|string|min:2|max:255',
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
            'company_name.required' => 'Company Name field is required',
            'jobs_role_id.required' => 'Please select Jobs role',
            'city_id.required' => 'City field is required',
            'industry_id.required' => 'Industry field is required',
            'address.required' => 'Address field is required',
            'postal_code.required' => 'Zip code field is required',
            'skills.required' => 'Skills is required',
            'languages.required' => 'Languages is required',
        ];
    }
}