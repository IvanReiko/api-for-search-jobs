<?php

namespace App\Http\Controllers\Dashboard\Candidate;


use App\Http\Controllers\Controller;
use App\Repositories\Web\CandidateRepository;
use Illuminate\Http\Request;


class CandidateController extends Controller
{
    private $candidate;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidate = $candidateRepository;
    }

    public function index()
    {
        $candidates = $this->candidate->paginate(10);
        return view('candidate.list', compact('candidates'));
    }

    public function show($id)
    {
        $candidate = $this->candidate->getById($id, ['recruiters', 'skills', 'candidate_work_experiences', 'candidate_educations', 'candidate_language_skills', 'candidate_documents']);
        return view('candidate.show', compact('candidate'));
    }

    public function wishlistIndex()
    {
        $wishlists = request()->user()->recruiter->candidates;
        return view('candidate.wishlist', compact('wishlists'));
    }

    public function approve(Request $request)
    {

    }
}
