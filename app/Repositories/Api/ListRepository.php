<?php

namespace App\Repositories\Api;


class ListRepository extends BaseApiRepository
{
    public function show($model, $parameters = [])
    {
        if ($model->getAttribute('weight')) {
            $model = $model->orderBy('weight');
        }

        if ($parameters['filter']) {
            $model = $model->where('name', 'like', $parameters['filter'] . '%');
        }

        return $model->paginate($parameters['per_page'], ['*'], 'page', $parameters['page']);
    }
}