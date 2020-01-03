<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyEditRequest;
use App\Models\Company;
use App\Models\CompanyBillingInfo;
use App\Repositories\Web\CompanyRepository;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;

use Auth;

class CompanyController extends Controller
{
    //
    private $company;

    public function __construct(CompanyRepository $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        $companies = $this->company->getAll();
        return view('company.index')->withCompanies($companies);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(CompanyCreateRequest $request)
    {
        $recruiter = Auth::user()->recruiter;
        if ($request->hasFile('logo_url')) {
            $image = $request->file('logo_url');
            $photo_url = $image->hashName();
            $image = Image::make($image)->fit(200, 200)->encode();
            \Storage::disk('public')->put($photo_url, (string)$image);
            $fields['logo_url'] = asset('storage/' . $photo_url);
        }
        else{
            return redirect()->back()->withInput();
        }
        $fields += $request->only(['name', 'address', 'postal_code', 'industry_id', 'city_id', 'website_url', 'description']);
        $company = Company::create((array)$fields);
        $recruiter->company()->associate($company);
        $recruiter->save();
        return redirect()->route('company.edit');
    }

    public function show($id)
    {
        $company = $this->company->getById($id);
        $billing = CompanyBillingInfo::find($id);
        return $company != null && $billing != null ? view('company.show', compact('company', 'billing')) : redirect(route('company.create'));
    }

    public function edit()
    {
        $company = $this->company->getModel();
        if (empty($company->name)) {
            return redirect()->route('company.create');
        }
        $industry = $company->industry;
        $city = $company->city;
        $country = $company->city->country;
        $billing = $company->company_billing_info;

        return view('company.edit', compact('company', 'city', 'country', 'industry', 'billing'));
    }

    public function update(CompanyEditRequest $request)
    {
        if ($request->hasFile('logo_url')) {
            $image = $request->file('logo_url');
            $this->company->fileDelete($this->company->getModel()->logo_url);
            $photo_url = $image->hashName();
            $image = Image::make($image)->fit(200, 200)->encode();
            \Storage::disk('public')->put($photo_url, (string)$image);
            $fields['logo_url'] = asset('storage/' . $photo_url);
        } else {
            $fields['logo_url'] = $this->company->getModel()->logo_url;
        }

//      TODO  $fields['logo_url'] = $request->file('logo_url')->store('logo');
        $fields += $request->only(['name', 'address', 'postal_code', 'industry_id', 'city_id', 'website_url', 'description']);
//      TODO  $this->validator->validate($fields);
        $this->company->update($fields);
        return redirect()->back();
    }

    public function delete($id)
    {

    }

}
