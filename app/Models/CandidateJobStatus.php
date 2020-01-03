<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateJobStatus
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidate_jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobStatus whereWeight($value)
 */
class CandidateJobStatus extends Model
{
    const ASSIGN = 1;
    const APPROVE = 2;
    const DISAPPROVE = 3;
    const HIRED = 4;

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

	public function candidate_jobs()
	{
		return $this->hasMany(\App\Models\CandidateJob::class);
	}
}
