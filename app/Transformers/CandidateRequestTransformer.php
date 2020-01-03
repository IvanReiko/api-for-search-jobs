<?php

namespace App\Transformers;

class CandidateRequestTransformer
{
    static function personalInformationUpdate($data)
    {
        return collect($data)->only([
            'full_name',
            'email',
            'phone_number',
            'city_id',
        ])->all();
    }

    static function filterGeneralUpdate($data)
    {
        return collect($data)->only([
            'salary_min',
            'salary_max',
            'experience_years_min',
            'experience_years_max',
            'employment_levels',
            'employment_types',
        ])->all();
    }
}