<?php

namespace App\Policies;

use App\User;
use App\Models\CandidateDocument;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidateDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  User  $user
     * @param  CandidateDocument  $candidateDocument
     * @return bool
     */
    public function documentDelete(User $user, CandidateDocument $candidateDocument)
    {
        return $user->candidate->id === $candidateDocument->candidate_id;
    }
}