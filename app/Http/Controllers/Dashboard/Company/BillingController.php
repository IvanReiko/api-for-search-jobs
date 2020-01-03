<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\Http\Requests\Company\BillingStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Web\BillingRepository;


class BillingController extends Controller
{
    private $billing;

    public function __construct(BillingRepository $billing)
    {
        $this->billing = $billing;
    }


    public function storeBilling(BillingStoreRequest $request)
    {
        $fields = $request->only(['first_name', 'last_name', 'company_name', 'vat', 'address', 'postal_code', 'company_id', 'city_id', 'email' ]);
        if($company_billing_info = \Auth::user()->recruiter->company->company_billing_info){
            $company_billing_info->update($fields);
        }else{
            $this->billing->create($fields);
        }
        return redirect()->back();
    }

}
