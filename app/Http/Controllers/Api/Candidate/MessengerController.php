<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Candidate\Job\PaginateListRequest;
use App\Http\Requests\Api\Candidate\MessageStoreRequest;
use App\Models\Job;
use App\Models\Message;
use App\Transformers\CandidateResponseTransformer;

class MessengerController extends ApiController
{
    public function index(PaginateListRequest $request)
    {
        $candidate = $request->user()->candidate;

        return $this->respondContent(CandidateResponseTransformer::dialogs(
            Message::with(['job', 'company'])
                ->where(['candidate_id' => $candidate->id])
                ->orderBy('id', 'DESC')
                ->get()
                ->unique('job_id')
        ));
    }

    public function show(Job $job)
    {
        return $this->respondContent(CandidateResponseTransformer::dialog(
            $job->messages()
                ->where(['candidate_id' => request()->user()->candidate->id])
                ->orderBy('id', 'DESC')
                ->get()
        ));
    }

    public function store(Job $job, MessageStoreRequest $request)
    {
        $user = request()->user();

        if(!Message::create([
            'job_id' => $job->id,
            'candidate_id' => $user->candidate->id,
            'recruiter_id' => $job->recruiter_id,
            'sender_id' => $user->id,
            'company_id' => $job->company_id,
            'message' => $request->message,
        ])){
            return $this->respondError();
        }

        return $this->respondCreated('Message created successfully');
    }
}
