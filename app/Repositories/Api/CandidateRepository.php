<?php

namespace App\Repositories\Api;

use App\Models\Candidate;
use App\Models\CandidateDocument;
use App\Models\City;
use App\Transformers\CandidateRequestTransformer;

class CandidateRepository extends BaseApiRepository
{
    public function personalInformationUpdate($data, $model = false)
    {
        return $this->getModel($model)->update(
            CandidateRequestTransformer::personalInformationUpdate($data)
        );
    }

    public function workExperiencesUpdate($data, $model = false)
    {
        $model = $this->getModel($model)->candidate_work_experiences();
        return $this->replaceBatch($data, $model);
    }

    public function educationsUpdate($data, $model = false)
    {
        $model = $this->getModel($model)->candidate_educations();
        return $this->replaceBatch($data, $model);
    }

    public function skillsUpdate($data, $model = false)
    {
        return $this->getModel($model)->skills()->sync($data);
    }

    public function languageSkillsUpdate($data, $model = false)
    {
        $model = $this->getModel($model)->candidate_language_skills();
        return $this->replaceBatch($data, $model);
    }

    public function documentExistDelete($file, $model = false)
    {
        $candidateDocuments = $this->getModel($model)->candidate_documents;
        $candidateDocuments->each(function ($candidateDocument) use ($file) {
            if (
                $candidateDocument->name == pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) &&
                $candidateDocument->type == $file->getClientOriginalExtension()
            ) {
                $this->fileDelete($candidateDocument);
            }
        });
        return;
    }

    public function documentSave($file, $model = false)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 120);

        $candidateDocument = new CandidateDocument();
        $candidateDocument->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $candidateDocument->type = $file->getClientOriginalExtension();
        $candidateDocument->size = (int)$file->getClientSize() / 1000;

        \Storage::disk('public')->putFile(null, $file);

        $candidateDocument->url = asset('storage/' . $file->hashName());

        return $this->getModel($model)->candidate_documents()->save($candidateDocument);
    }

    public function settingsUpdate($data = [], $model = false)
    {
        return $this->getModel($model)->candidate_setting->update($data);
    }

    public function filterGeneralUpdate($data = [], $model = false)
    {
        return $this->getModel($model)->update(
            CandidateRequestTransformer::filterGeneralUpdate($data)
        );
    }

    public function jobRolesUpdate($data, $model = false)
    {
        return $this->getModel($model)->job_roles()->sync($data);
    }

    public function industriesUpdate($data, $model = false)
    {
        return $this->getModel($model)->industries()->sync($data);
    }

    public function employmentLevelsUpdate($data, $model = false)
    {
        return $this->getModel($model)->employment_levels()->sync($data);
    }

    public function employmentTypesUpdate($data, $model = false)
    {
        return $this->getModel($model)->employment_types()->sync($data);
    }

    public function cityUpdate($city_id, $model = false)
    {
        $city = City::findOrFail($city_id);
        return $this->getModel($model)->city()->associate($city)->save();
    }

    public function filterCitiesUpdate($data, $model = false)
    {
        return $this->getModel($model)->filter_cities()->sync($data);
    }

    public function getModel($model = false, $with = [])
    {
        if (!$model) {
            return request()->user()->load(self::prepareLoadRelation($with, 'candidate'))->candidate;
        }
        return $model = is_object($model) ? $model : Candidate::findOrFail($model)->load(self::prepareLoadRelation($with, 'candidate', false));
    }

    protected function replaceBatch($data, $model)
    {
        $model->delete();
        return $this->createBatch($data, $model);
    }

    protected function createBatch($data, $model)
    {
        foreach (collect($data)->filter()->all() as $value) {
            if (!$model->create($value)) {
                return false;
            }
        }
        return true;
    }
}