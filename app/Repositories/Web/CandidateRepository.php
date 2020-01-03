<?php


namespace App\Repositories\Web;

use App\Models\Candidate;
use App\User;

class CandidateRepository extends BaseWebRepository
{
    protected $model;

    public function __construct(Candidate $candidate)
    {
        $this->model = $candidate;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id, $with = [])
    {
        return empty($with) ? $this->model->findOrFail($id) : $this->model->findOrFail($id)->load($with);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model = false, $data)
    {
        return $this->getModel()->update($data);
    }

    public function delete($model = false)
    {
        return $this->getModel($model)->delete();
    }

    public function paginate($page = 10)
    {
        return $this->model->paginate($page);
    }

    public function getModel($model = false, $with = [])
    {
        if (!$model) {
            return request()->user()->load(self::prepareLoadRelation($with, 'candidate'))->candidate;
        }
        return $model = is_object($model) ? $model : Candidate::findOrFail($model)->load(self::prepareLoadRelation($with, 'candidate', false));
    }
}