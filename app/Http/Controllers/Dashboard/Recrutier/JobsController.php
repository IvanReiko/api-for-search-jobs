<?php

namespace App\Http\Controllers\Dashboard\Recrutier;

use App\Http\Requests\Job\JobRequest;
use App\Models\Candidate;
use App\Models\Job;
use App\Repositories\Web\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\JobInterface;
use App\Models\EmploymentLevel;
use App\Models\EmploymentType;
use App\Models\CandidateJobStatus;
use App\Models\JobStatus;
use Auth;

class JobsController extends Controller
{
    private $job;
    private $company;

    public function __construct(JobInterface $job, CompanyRepository $company)
    {
        $this->job = $job;
        $this->company = $company;
    }

    public function index()
    {
        $recruiter = Auth::user()->recruiter;
        $jobs = $recruiter->jobs()->get();
        return view('jobs.index')->withJobs($jobs);
    }

    public function create()
    {
        if ($this->company->getModel() == null) {
            return redirect()->route('company.create', ['alert' => 1]);
        }
        $company = $this->company->getModel();
        $industry = $company->industry;
        $city = $company->city;
        $country = $company->city->country;
        return view('jobs.create', compact('company', 'industry', 'city', 'country'));
    }

    public function store(JobRequest $request)
    {
        $recruiter = Auth::user()->recruiter;
        $company = $recruiter->company;

        $fields = $request->only([
            'job_role_id',
            'company_name',
            'city_id',
            'address',
            'industry_id',
            'full_time',
            'part_time',
            'regular_employment',
            'citizen_contract',
            'experience_years_min',
            'experience_years_max',
            'salary_min',
            'salary_max',
            'description'
        ]);
        $fields['job_status_id'] = JobStatus::DRAFT;
        $fields['recruiter_id'] = $recruiter->id;
        $fields['company_id'] = $recruiter->company_id;
        $fields['company_name'] = !empty($fields['company_name']) ? $fields['company_name'] : $company->name;
        $fields['address'] = !empty($fields['address']) ? $fields['address'] : $company->address;
        $fields['industry_id'] = !empty($fields['industry_id']) ? $fields['industry_id'] : $company->industry_id;
        $fields['city_id'] = !empty($fields['city_id']) ? $fields['city_id'] : $company->city_id;
        $employments_level = array();
        if (!empty($fields['full_time'])) array_push($employments_level, EmploymentLevel::FULL_TIME);
        if (!empty($fields['part_time'])) array_push($employments_level, EmploymentLevel::PART_TIME);
        $employments_types = array();
        if (!empty($fields['regular_employment'])) array_push($employments_types, EmploymentType::REGULAR_EMPLOYMENT);
        if (!empty($fields['citizen_contract'])) array_push($employments_types, EmploymentType::CITIZEN_CONTRACT);

        $job = $this->job->create($fields);

        $job->employment_levels()->sync($employments_level);
        $job->employment_types()->sync($employments_types);
        $job->skills()->sync(explode(',', $request->skills));
        $job->languages()->sync(explode(',', $request->input('languages')));

        switch ($request->input('action')) {
            case 'draft':
                return redirect()->route('job.draft');
                break;
            case 'preview':
                return redirect()->route('job.paste.link', [$job->id]);
                //return redirect()->route('job.confirm.show', [$job->id]);
                break;
        }
    }

    public function storeOfferUrl(Request $request, Job $job)
    {
        $job->offer_url = $request->offer_url;
        $job->save();
        return redirect()->route('job.confirm.show', [$job->id]);
    }

    public function pasteLink(Job $job)
    {
        return view('jobs.paste-link', compact('job'));
    }

    public function confirmShow(Job $job)
    {
        return view('jobs.confirm', compact('job'));
    }

    public function confirmUpdate(Request $request)
    {
        $job = Job::findOrFail($request->id);
        $job->job_status_id = JobStatus::ACTIVE;
        if ($job->save()) {
            return view('jobs.thanks', compact('job'));
        }
    }

    public function show($id)
    {
        $job = $this->job->getById($id);
        $assign_candidates = $job->candidates()->where('candidate_job_status_id', '=', CandidateJobStatus::ASSIGN)->get();
        $approved_candidates = $job->candidates()->where('candidate_job_status_id', '=', CandidateJobStatus::APPROVE)->get();       
        $disapproved_candidates = $job->candidates()->where('candidate_job_status_id', '=', CandidateJobStatus::DISAPPROVE)->get();
        return view('jobs.show', compact('job', 'approved_candidates', 'disapproved_candidates', 'assign_candidates'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function thanks()
    {
        return view('jobs.thanks');
    }

    public function draft()
    {
        return view('jobs.save-draft');
    }

}
