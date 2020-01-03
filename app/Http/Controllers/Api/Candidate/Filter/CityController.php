<?php

namespace App\Http\Controllers\Api\Candidate\Filter;

use App\Repositories\Api\CandidateRepository;
use App\Http\Requests\Api\Candidate\Filter\CityStoreRequest;
use App\Http\Controllers\Api\ApiController;
use App\Transformers\CandidateResponseTransformer;

class CityController extends ApiController
{
    protected $candidates;

    public function __construct(CandidateRepository $candidates)
    {
        $this->candidates = $candidates;
    }

    public function index()
    {
        return $this->respondContent(CandidateResponseTransformer::cities(
            $this->candidates->getModel(false, ['filter_cities.country'])->filter_cities
        ));
    }

    public function store(CityStoreRequest $request)
    {
        if(!$this->candidates->filterCitiesUpdate($request->cities)){
            return $this->respondError();
        }

        return $this->respondCreated('Cities changed successfully');
    }
}
