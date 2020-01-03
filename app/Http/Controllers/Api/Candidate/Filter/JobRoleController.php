<?php

namespace App\Http\Controllers\Api\Candidate\Filter;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Filter\JobRolesStoreRequest;
use App\Http\Controllers\Api\ApiController;
use App\Transformers\BaseResponseTransformer;

class JobRoleController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(BaseResponseTransformer::baseLists($this->candidates->getModel()->job_roles));
    }

    public function store(JobRolesStoreRequest $request)
    {
        if(!$this->candidates->jobRolesUpdate($request->job_roles)){
            return $this->respondError();
        }

        return $this->respondCreated('Job roles changed successfully');
    }
}
