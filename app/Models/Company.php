<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @property int $id
 * @property int $city_id
 * @property int $industry_id
 * @property string $name
 * @property string $address
 * @property string $postal_code
 * @property string $logo_url
 * @property string $website_url
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\City $city
 * @property \App\Models\Industry $industry
 * @property \App\Models\CompanyBillingInfo $company_billing_info
 * @property \App\Models\Recruiter $recruiter
 * @property \Illuminate\Database\Eloquent\Collection $messages
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereWebsiteUrl($value)
 */
class Company extends Model
{
    protected $casts = [
        'city_id' => 'int',
        'industry_id' => 'int'
    ];

    protected $fillable = [
        'city_id',
        'industry_id',
        'name',
        'address',
        'postal_code',
        'logo_url',
        'website_url',
        'description'
    ];

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }

    public function industry()
    {
        return $this->belongsTo(\App\Models\Industry::class);
    }

    public function company_billing_info()
    {
        return $this->hasOne(\App\Models\CompanyBillingInfo::class);
    }

    public function recruiter()
    {
        return $this->hasOne(\App\Models\Recruiter::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }
}
