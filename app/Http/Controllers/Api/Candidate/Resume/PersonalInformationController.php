<?php

namespace App\Http\Controllers\Api\Candidate\Resume;

use App\Http\Requests\ImageUploadRequest;
use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Resume\PersonalInformationStoreRequest;
use App\Transformers\CandidateResponseTransformer;
use App\Http\Controllers\Api\ApiController;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class PersonalInformationController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }

    public function index()
    {
        return $this->respondContent(
            CandidateResponseTransformer::personalInformation($this->candidates->getModel(false, ['city.country']))
        );
    }

    public function store(PersonalInformationStoreRequest $request)
    {
        if (!$this->candidates->personalInformationUpdate($request)) {
            return $this->respondError();
        }

        return $this->respondCreated('Personal information changed successfully');
    }

    public function photoUpload(ImageUploadRequest $request)
    {
        $candidate = $this->candidates->getModel();
        $image = $request->file('image');

        $this->candidates->fileDelete($candidate->photo_url);

        $candidate->photo_url = $image->hashName();

        $image = Image::make($image)->fit(600, 600)->encode();
        Storage::disk('public')->put($candidate->photo_url, (string) $image);

        $candidate->photo_url = asset('storage/'.$candidate->photo_url);
        $candidate->save();

        return $this->respondCreated([
            'photo_url' => $candidate->photo_url
        ]);
    }
}
