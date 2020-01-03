<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Models\CandidateDocument;
use App\Repositories\Api\CandidateRepository;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\DocumetUploadRequest;

class DocumentController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }

    public function index()
    {
        return $this->respondContent(
            CandidateResponseTransformer::documents($this->candidates->getModel()->candidate_documents)
        );
    }

    public function documentUpload(DocumetUploadRequest $request)
    {
        $file = $request->file('document');
        $this->candidates->documentExistDelete($file);

        return $this->respondCreated(
            CandidateResponseTransformer::document(
                $this->candidates->documentSave($file)
            )
        );
    }

    public function documentDelete(CandidateDocument $candidateDocument)
    {
        $this->authorize('documentDelete', $candidateDocument);

        $this->candidates->fileDelete($candidateDocument);

        return $this->respondSuccess('Document delete successfully');
    }
}
