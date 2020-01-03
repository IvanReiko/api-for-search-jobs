<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmploymentType
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentType whereWeight($value)
 */
class EmploymentType extends Model
{
    const REGULAR_EMPLOYMENT = 1;
    const CITIZEN_CONTRACT = 2;

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'weight' => 'int'
	];

	protected $fillable = [
		'id',
		'name',
		'weight'
	];

	public function candidates()
	{
		return $this->belongsToMany(\App\Models\Candidate::class);
	}

	public function jobs()
	{
		return $this->belongsToMany(\App\Models\Job::class);
	}
}
