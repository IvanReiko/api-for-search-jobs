<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use App\Models\EmploymentLevel;
use App\Models\EmploymentType;
use App\Models\Industry;
use App\Models\JobRole;
use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\Skill;
use App\Repositories\Api\ListRepository;
use App\Transformers\BaseResponseTransformer;
use Illuminate\Http\Request;

class ListController extends ApiController
{
    protected $lists;

    public function __construct(ListRepository $lists)
    {
        $this->lists = $lists;
    }

    public function jobRoles(Request $request)
    {
        return $this->showList(new JobRole(), $request);
    }

    public function skills(Request $request)
    {
        return $this->showList(new Skill(), $request);
    }

    public function industries(Request $request)
    {
        return $this->showList(new Industry(), $request);
    }

    public function languages(Request $request)
    {
        return $this->showList(new Language(), $request, ['native_name']);
    }

    public function cities(Request $request)
    {
        return $this->showList(new City(), $request, ['country_id']);
    }

    public function countries(Request $request)
    {
        return $this->showList(new Country(), $request);
    }

    public function languageLevels()
    {
        return $this->showList(LanguageLevel::all());
    }

    public function employmentTypes()
    {
        return $this->showList(EmploymentType::all());
    }

    public function employmentLevels()
    {
        return $this->showList(EmploymentLevel::all());
    }

    protected function showList($model, $parametersPaginateRequest = false, $withAttributes = [])
    {
        if($parametersPaginateRequest){
            $response = $this->lists->show($model, $this->lists->parametersPaginate($parametersPaginateRequest));
        }else{
            $response = $model;
        }

        return $this->respondContent(BaseResponseTransformer::baseLists($response, $withAttributes));
    }
}
