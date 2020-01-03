<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobRole
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobRole whereWeight($value)
 */
class JobRole extends Model
{
	public $timestamps = false;

	protected $casts = [
		'weight' => 'int'
	];

	protected $fillable = [
		'name',
		'weight'
	];

	public function candidates()
	{
		return $this->belongsToMany(\App\Models\Candidate::class);
	}

	public function jobs()
	{
		return $this->hasMany(\App\Models\Job::class);
	}
}
