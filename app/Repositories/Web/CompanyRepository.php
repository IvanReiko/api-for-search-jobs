<?php
/**
 * Created by PhpStorm.
 * User: A.Klapchuk
 * Date: 15.03.2018
 * Time: 13:37
 */

namespace App\Repositories\Web;

//use App\Repositories\Contracts\CompanyInterface;
use App\Models\Company;

class CompanyRepository extends BaseWebRepository
{
    public function getAll()
    {
        return $this->getModel()->all();
    }

    public function getById($id)
    {
        return $this->getModel()->find($id);
    }

    public function create(array $fields)
    {
        return $this->getModel()->create($fields);
    }

    public function update($fields)
    {
        return $this->getModel()->update($fields);
    }

    public function delete($id)
    {
        return $this->getModel()->delete();
    }
    
    public function getModel($model = false, $with = [])
    {
        if (!$model) {
            return request()->user()->load(self::prepareLoadRelation($with, 'recruiter'))->recruiter->company;
        }
        return $model = is_object($model) ? $model : Company::findOrFail($model)->load(self::prepareLoadRelation($with, 'recruiter', false));
    }
}