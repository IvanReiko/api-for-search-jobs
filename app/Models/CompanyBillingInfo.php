<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyBillingInfo
 *
 * @property int $id
 * @property int $company_id
 * @property int $city_id
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $vat
 * @property string $address
 * @property string $postal_code
 * @property string $email
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\City $city
 * @property \App\Models\Company $company
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanyBillingInfo whereVat($value)
 */
class CompanyBillingInfo extends Model
{
    public $timestamps = false;

    protected $casts = [
        'company_id' => 'int',
        'city_id' => 'int'
    ];

    protected $fillable = [
        'company_id',
        'city_id',
        'first_name',
        'last_name',
        'company_name',
        'vat',
        'address',
        'postal_code',
        'email'
    ];

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
