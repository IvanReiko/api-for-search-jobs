<?php

namespace App\Transformers;

class CandidateResponseTransformer extends BaseResponseTransformer
{
    static function personalInformation($data)
    {
        return [
            'full_name' => $data->full_name,
            'photo_url' => $data->photo_url,
            'email' => $data->email,
            'phone_number' => $data->phone_number,
            'city' => self::city($data->city),
        ];
    }

    static function workExperiences($data)
    {
        return $data->map(function ($model) {
            return collect($model)->only([
                'id',
                'position',
                'company_name',
                'company_website_url',
                'description',
                'started_at',
                'ended_at',
            ])->all();
        });
    }

    static function educations($data)
    {
        return $data->map(function ($model) {
            return collect($model)->only([
                'id',
                'field_of_study',
                'degree',
                'school_name',
                'final_grade',
                'school_website_url',
                'description',
                'started_at',
                'ended_at',
            ])->all();
        });
    }

    static function languageSkills($data)
    {
        return $data->map(function ($model) {
            return [
                'language' => self::base($model->language, ['native_name']),
                'language_level_speaking' => self::base($model->language_level_speaking),
                'language_level_writing' => self::base($model->language_level_writing),
            ];
        });
    }

    static function documents($data)
    {
        return $data->map(function ($model) {
            return self::document($model);
        });
    }

    static function document($data)
    {
        return collect($data)->only([
            'id',
            'name',
            'url',
            'type',
            'size',
        ])->all();
    }

    static function settings($data)
    {
        return [
            'is_notification_for_new_job' => $data->is_notification_for_new_job,
            'is_notification_for_new_message' => $data->is_notification_for_new_message,
            'is_notification_for_new_match' => $data->is_notification_for_new_match,
            'is_receive_email_for_new_job' => $data->is_receive_email_for_new_job,
            'is_receive_email_for_new_message' => $data->is_receive_email_for_new_message,
            'is_receive_email_for_new_match' => $data->is_receive_email_for_new_match,
            'google_token' => $data->google_token ? 'isset' : null,
            'linkedin_token' => $data->linkedin_token ? 'isset' : null,
            'fcm_token' => $data->fcm_token ? 'isset' : null,
        ];
    }

    static function job($data)
    {
        $data = (object)$data[0];
        return [
            'id' => $data->id,
            'experience_years_min' => $data->experience_years_min,
            'experience_years_max' => $data->experience_years_max,
            'salary_min' => $data->salary_min,
            'salary_max' => $data->salary_max,
            'job_role' => self::base($data->job_role),
            'industry' => self::base($data->industry),
            'employment_levels' => self::baseLists($data->employment_levels),
            'employment_types' => self::baseLists($data->employment_types),
            'company' => [
                'id' => $data->recruiter->company->id,
                'logo_url' => $data->recruiter->company->logo_url,
                'name' => $data->company_name,
                'city' => self::city($data->city),
            ],
        ];
    }

    static function jobDetails($data)
    {
        $data = (object)$data;
        return [
            'id' => $data->id,
            'description' => $data->description,
            'experience_years_min' => $data->experience_years_min,
            'experience_years_max' => $data->experience_years_max,
            'salary_min' => $data->salary_min,
            'salary_max' => $data->salary_max,
            'job_role' => self::base($data->job_role),
            'industry' => self::base($data->industry),
            'company' => [
                'id' => $data->recruiter->company->id,
                'logo_url' => $data->recruiter->company->logo_url,
                'name' => $data->company_name,
                'city' => self::city($data->city),
                'address' => $data->address,
                'postal_code' => $data->recruiter->company->postal_code,
            ],
            'skills' => self::baseLists($data->skills),
            'languages' => self::languages($data->languages),
            'employment_levels' => self::baseLists($data->employment_levels),
            'employment_types' => self::baseLists($data->employment_types),
        ];
    }

    static function dialogs($data)
    {
        $arr = [];
        foreach ($data as $dialog){
            $arr[] = [
                'job_id' => $dialog->job_id,
                'message' => str_limit($dialog->message),
                'created_at' => $dialog->created_at,
                'company' => [
                    'id' => $dialog->company->id,
                    'name' => $dialog->company->name,
                    'logo_url' => $dialog->company->logo_url,
                ],
            ];
        }
        return $arr;
    }

    static function dialog($data)
    {
        $user_id = request()->user()->id;

        return $data->map(function ($model) use ($user_id){
            return [
                'message' => $model->message,
                'is_sender' => $model->sender_id == $user_id ? true : false,
                'created_at' => $model->created_at,
            ];
        });
    }
}