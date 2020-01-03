<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Repositories\Api\CandidateRepository;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;

class IndexController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }

    public function index()
    {
        $candidate = $this->candidates->getModel(false, ['candidate_work_experiences', 'candidate_educations', 'skills', 'candidate_language_skills', 'candidate_language_skills.language', 'candidate_language_skills.language_level_speaking', 'candidate_language_skills.language_level_writing', 'candidate_documents']);

        return $this->respondContent([
            'personal_information' => CandidateResponseTransformer::personalInformation($candidate),
            'work_experiences' => CandidateResponseTransformer::workExperiences($candidate->candidate_work_experiences),
            'educations' => CandidateResponseTransformer::educations($candidate->candidate_educations),
            'skills' => CandidateResponseTransformer::baseLists($candidate->skills),
            'language_skills' => CandidateResponseTransformer::languageSkills($candidate->candidate_language_skills),
            'documents' => CandidateResponseTransformer::documents($candidate->candidate_documents),
        ]);
    }
}