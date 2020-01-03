<?php

namespace App\Http\Controllers\Api\Candidate\Filter;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Filter\IndustriesStoreRequest;
use App\Http\Controllers\Api\ApiController;
use App\Transformers\BaseResponseTransformer;

class IndustryController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(BaseResponseTransformer::baseLists($this->candidates->getModel()->industries));
    }

    public function store(IndustriesStoreRequest $request)
    {
        if(!$this->candidates->industriesUpdate($request->industries)){
            return $this->respondError();
        }

        return $this->respondCreated('Industries changed successfully');
    }
}
