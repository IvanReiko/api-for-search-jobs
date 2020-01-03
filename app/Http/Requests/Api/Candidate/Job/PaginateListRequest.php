<?php

namespace App\Http\Requests\Api\Candidate\Job;

use Illuminate\Foundation\Http\FormRequest;

class PaginateListRequest extends FormRequest
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
            'without'   => 'nullable|array',
            'without.*'   => 'nullable|integer|distinct|min:1',
            'page'   => 'nullable|integer|min:1',
        ];
    }
}
