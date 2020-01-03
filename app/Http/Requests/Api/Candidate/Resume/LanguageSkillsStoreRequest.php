<?php

namespace App\Http\Requests\Api\Candidate\Resume;

use Illuminate\Foundation\Http\FormRequest;

class LanguageSkillsStoreRequest extends FormRequest
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
            'language_skills'                              => 'present|array',
            'language_skills.*.language_id'                => 'required|string|distinct|min:1',
            'language_skills.*.language_level_speaking_id' => 'required|integer|min:1',
            'language_skills.*.language_level_writing_id'  => 'required|integer|min:1',
        ];
    }
}
