<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Resume\SkillsStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class SkillController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(
            CandidateResponseTransformer::baseLists($this->candidates->getModel()->skills)
        );
    }

    public function store(SkillsStoreRequest $request)
    {
        if(!$this->candidates->skillsUpdate($request->skills)){
            return $this->respondError();
        }

        return $this->respondCreated('Skills changed successfully');
    }
}
