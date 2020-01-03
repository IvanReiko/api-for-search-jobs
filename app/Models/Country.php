<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 *
 * @property string $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereWeight($value)
 */
class Country extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'weight' => 'int'
    ];

    protected $fillable = [
        'id',
        'name',
        'weight'
    ];

    public function cities()
    {
        return $this->hasMany(\App\Models\City::class, 'country_id');
    }
}
