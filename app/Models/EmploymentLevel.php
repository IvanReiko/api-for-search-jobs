<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmploymentLevel
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmploymentLevel whereWeight($value)
 */
class EmploymentLevel extends Model
{
    const FULL_TIME = 1;
    const PART_TIME = 2;

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
