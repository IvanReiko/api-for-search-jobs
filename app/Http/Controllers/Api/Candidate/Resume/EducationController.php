<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Resume\EducationsStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class EducationController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(CandidateResponseTransformer::educations(
            $this->candidates->getModel()->candidate_educations
        ));
    }

    public function store(EducationsStoreRequest $request)
    {
        if(!$this->candidates->educationsUpdate($request->educations)){
            return $this->respondError();
        }

        return $this->respondCreated('Education changed successfully');
    }
}
