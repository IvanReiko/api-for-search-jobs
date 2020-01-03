<?php

namespace App\Http\Requests\Api\Candidate\Resume;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonalInformationStoreRequest extends FormRequest
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
            'full_name'    => 'required|string|max:255',
            'email'        => ['required', 'string', 'email', 'max:255', Rule::unique('candidates', 'email')->ignore(request()->user()->id, 'user_id')],
            'phone_number' => ['required', 'string', 'digits_between:10,14', Rule::unique('candidates', 'phone_number')->ignore(request()->user()->id, 'user_id')],
            'city_id' => 'nullable|integer|min:1',
        ];
    }
}
