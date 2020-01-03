<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Resume\LanguageSkillsStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class LanguageSkillController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }
    
    public function index()
    {
        return $this->respondContent(CandidateResponseTransformer::languageSkills(
            $this->candidates->getModel(false, ['candidate_language_skills.language', 'candidate_language_skills.language_level_speaking', 'candidate_language_skills.language_level_writing'])->candidate_language_skills
        ));
    }

    public function store(LanguageSkillsStoreRequest $request)
    {
        if(!$this->candidates->languageSkillsUpdate($request->language_skills)){
            return $this->respondError();
        }

        return $this->respondCreated('Language skills changed successfully');
    }
}
