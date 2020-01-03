<?php

namespace App\Http\Requests\Api\Candidate\Resume;

use Illuminate\Foundation\Http\FormRequest;

class EducationsStoreRequest extends FormRequest
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
            'educations'                      => 'present|array',
            'educations.*.field_of_study'     => 'required|string|max:255',
            'educations.*.degree'             => 'required|string|max:255',
            'educations.*.school_name'        => 'required|string|max:255',
            'educations.*.started_at'         => 'required|date|date_format:Y-m-d',
            'educations.*.ended_at'           => 'nullable|date|date_format:Y-m-d',
            'educations.*.final_grade'        => 'nullable|string|max:255',
            'educations.*.school_website_url' => 'nullable|url|max:255',
            'educations.*.description'        => 'nullable|string|max:2000',
        ];
    }
}
