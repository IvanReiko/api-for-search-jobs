<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\SettingsStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class SettingController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(CandidateResponseTransformer::settings($this->candidates->getModel()->candidate_setting));
    }

    public function store(SettingsStoreRequest $request)
    {
        if(!$this->candidates->settingsUpdate($request->input())){
            return $this->respondError();
        }

        return $this->respondCreated('Settings changed successfully');
    }
}
