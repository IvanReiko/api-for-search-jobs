<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 *
 * @property int $id
 * @property string $country_id
 * @property string $name
 * @property int $weight
 * @property \App\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $companies
 * @property \Illuminate\Database\Eloquent\Collection $company_billing_infos
 * @property \Illuminate\Database\Eloquent\Collection $filter_candidates
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereWeight($value)
 */
class City extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'weight' => 'int'
    ];

    protected $fillable = [
        'country_id',
        'name',
        'weight'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function candidates()
    {
        return $this->hasMany(\App\Models\Candidate::class);
    }

    public function filter_candidates()
    {
        return $this->belongsToMany(\App\Models\Candidate::class, 'candidate_filter_city');
    }

    public function companies()
    {
        return $this->hasMany(\App\Models\Company::class, 'city_id');
    }

    public function company_billing_infos()
    {
        return $this->hasMany(\App\Models\CompanyBillingInfo::class, 'city_id');
    }
}
