<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Resume\WorkExperiencesStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class WorkExperienceController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(
            CandidateResponseTransformer::workExperiences($this->candidates->getModel()->candidate_work_experiences)
        );
    }

    public function store(WorkExperiencesStoreRequest $request)
    {
        if(!$this->candidates->workExperiencesUpdate($request->work_experiences)){
            return $this->respondError();
        }

        return $this->respondCreated('Work experiences changed successfully');
    }
}
