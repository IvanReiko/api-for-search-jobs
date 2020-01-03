<?php

namespace App\Http\Requests\Api\Candidate\Filter;

use Illuminate\Foundation\Http\FormRequest;

class IndustriesStoreRequest extends FormRequest
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
            'industries'   => 'present|array',
            'industries.*' => 'nullable|integer|distinct|min:1',
        ];
    }
}
