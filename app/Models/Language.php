<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @property string $id
 * @property string $name
 * @property string $native_name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @property \App\Models\Localization $localization
 * @property \Illuminate\Database\Eloquent\Collection $recruiters
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereWeight($value)
 */
class Language extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'weight' => 'int'
    ];

    protected $fillable = [
        'id',
        'name',
        'native_name',
        'weight'
    ];

    public function candidates()
    {
        return $this->hasMany(\App\Models\Candidate::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(\App\Models\Job::class);
    }

    public function localization()
    {
        return $this->hasOne(\App\Models\Localization::class);
    }

    public function recruiters()
    {
        return $this->hasMany(\App\Models\Recruiter::class);
    }
}
