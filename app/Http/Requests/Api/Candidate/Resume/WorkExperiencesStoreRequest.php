<?php

namespace App\Http\Requests\Api\Candidate\Resume;

use Illuminate\Foundation\Http\FormRequest;

class WorkExperiencesStoreRequest extends FormRequest
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
            'work_experiences'                       => 'present|array',
            'work_experiences.*.position'            => 'required|string|max:255',
            'work_experiences.*.company_name'        => 'required|string|max:255',
            'work_experiences.*.started_at'          => 'required|date|date_format:Y-m-d',
            'work_experiences.*.ended_at'            => 'nullable|date|date_format:Y-m-d',
            'work_experiences.*.company_website_url' => 'nullable|url|max:255',
            'work_experiences.*.description'         => 'nullable|string|max:2000',
        ];
    }
}
