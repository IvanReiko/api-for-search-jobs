<?php

namespace App\Http\Requests\Api\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class SettingsStoreRequest extends FormRequest
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
            'is_notification_for_new_job'      => 'nullable|boolean',
            'is_notification_for_new_message'  => 'nullable|boolean',
            'is_notification_for_new_match'    => 'nullable|boolean',
            'is_receive_email_for_new_job'     => 'nullable|boolean',
            'is_receive_email_for_new_message' => 'nullable|boolean',
            'is_receive_email_for_new_match'   => 'nullable|boolean',
            'google_token'                     => 'nullable|string|max:255',
            'linkedin_token'                   => 'nullable|string|max:255',
            'fcm_token'                        => 'nullable|string|max:255',
        ];
    }
}
