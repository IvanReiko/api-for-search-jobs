<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Candidate\Job\PaginateListRequest;
use App\Models\Job;
use App\Repositories\Api\JobRepository;
use App\Transformers\CandidateResponseTransformer;

class JobController extends ApiController
{
    protected $jobs;

    public function __construct(JobRepository $jobs)
    {
        $this->jobs = $jobs;
    }

    public function index(PaginateListRequest $request)
    {
        $parameters = $this->parametersPaginate($request);

        return $this->respondContent(CandidateResponseTransformer::job(
            Job::with(['job_role', 'industry', 'recruiter.company', 'employment_levels', 'employment_types', 'city', 'city.country'])
                ->active()
                ->whereNotIn('id', $parameters['without'])
                ->paginate(1, ['*'], 'page', $parameters['page'])
        ));
    }

    public function parametersPaginate($request)
    {
        return [
            'page'     => $request->page ? $request->page : 1,
            'without'  => !empty($request->without) ? $request->without : [],
        ];
    }

    public function show(Job $job)
    {
        return $this->respondContent(CandidateResponseTransformer::jobDetails($job->load(['job_role', 'industry', 'languages', 'skills', 'employment_levels', 'employment_types', 'city', 'city.country', 'recruiter.company'])));
    }
}
