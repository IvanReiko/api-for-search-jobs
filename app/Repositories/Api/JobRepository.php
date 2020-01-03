<?php

namespace App\Repositories\Api;


use App\Models\Job;

class JobRepository extends BaseApiRepository
{
    public function show($model, $parameters = [])
    {
        return Job::all()->whereNotIn('id', $parameters['without'])->paginate($parameters['per_page'], ['*'], 'page', $parameters['page']);
    }
}