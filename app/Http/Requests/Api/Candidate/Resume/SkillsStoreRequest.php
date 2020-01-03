<?php

namespace App\Http\Requests\Api\Candidate\Resume;

use Illuminate\Foundation\Http\FormRequest;

class SkillsStoreRequest extends FormRequest
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
            'skills'   => 'present|array',
            'skills.*' => 'required|integer|distinct|min:1',
        ];
    }
}
