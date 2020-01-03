<?php

namespace App\Repositories\Web;

use App\Models\Recruiter;

class RecruiterRepository extends BaseWebRepository
{
    protected $model;

    public function __construct(Recruiter $recruiter)
    {
        $this->model = $recruiter;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model = false, $data)
    {
        return $this->getModel($model)->update($data);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function paginate($page = 10)
    {
        return $this->model->paginate($page);
    }

    public function wishlistAdd($id)
    {
        return $this->getModel()->candidates()->toggle($id);
    }

    public function teamCreate($data)
    {
        return $this->getModel()->recruiter_invites()->create([
            'email' => $data->email,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'hash' => md5($data->first_name . $data->last_name),
            'position' => $data->position
        ]);
    }

    public function getModel($model = false, $with = [])
    {
        if (!$model) {
            return request()->user()->load(self::prepareLoadRelation($with, 'recruiter'))->recruiter;
        }
        return $model = is_object($model) ? $model : Recruiter::findOrFail($model)->load(self::prepareLoadRelation($with, 'recruiter', false));
    }
}