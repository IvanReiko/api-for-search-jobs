<?php

namespace App\Http\Controllers\Api\Candidate\Filter;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Filter\GeneralStoreRequest;
use App\Http\Controllers\Api\ApiController;
use App\Transformers\BaseResponseTransformer;

class GeneralController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        $candidate = $this->candidates->getModel(false, ['employment_levels', 'employment_types']);
        return $this->respondContent([
            'salary_min' => $candidate->salary_min,
            'salary_max' => $candidate->salary_max,
            'experience_years_min' => $candidate->experience_years_min,
            'experience_years_max' => $candidate->experience_years_max,
            'employment_levels' => BaseResponseTransformer::baseLists($candidate->employment_levels),
            'employment_types' => BaseResponseTransformer::baseLists($candidate->employment_types),
        ]);
    }

    public function store(GeneralStoreRequest $request)
    {
        if(
            !$this->candidates->employmentLevelsUpdate($request->employment_levels) ||
            !$this->candidates->employmentTypesUpdate($request->employment_types) ||
            !$this->candidates->filterGeneralUpdate([
                'salary_min' => $request->salary_min,
                'salary_max' => $request->salary_max,
                'experience_years_min' => $request->experience_years_min,
                'experience_years_max' => $request->experience_years_max,
            ])
        ){
            return $this->respondError();
        }

        return $this->respondCreated('General filter changed successfully');
    }
}
