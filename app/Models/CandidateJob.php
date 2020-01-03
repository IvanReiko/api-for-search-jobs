<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateJob
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $job_id
 * @property int $candidate_job_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\CandidateJobStatus $candidate_job_status
 * @property \App\Models\Candidate $candidate
 * @property \App\Models\Job $job
 * @property \Illuminate\Database\Eloquent\Collection $candidate_job_notes
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereCandidateJobStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJob whereUpdatedAt($value)
 */
class CandidateJob extends Model
{
	protected $casts = [
		'candidate_id' => 'int',
		'job_id' => 'int',
		'candidate_job_status_id' => 'int'
	];

	protected $fillable = [
		'candidate_id',
		'job_id',
		'candidate_job_status_id'
	];

	public function candidate_job_status()
	{
		return $this->belongsTo(\App\Models\CandidateJobStatus::class);
	}

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}

	public function job()
	{
		return $this->belongsTo(\App\Models\Job::class);
	}

	public function candidate_job_notes()
	{
		return $this->hasMany(\App\Models\CandidateJobNote::class);
	}
}
