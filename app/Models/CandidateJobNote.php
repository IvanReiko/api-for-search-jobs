<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateJobNote
 *
 * @property int $id
 * @property int $candidate_job_id
 * @property string $note
 * @property \Carbon\Carbon $created_at
 * @property \App\Models\CandidateJob $candidate_job
 * @package App\Models
 * @mixin \Eloquent
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobNote whereCandidateJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateJobNote whereUpdatedAt($value)
 */
class CandidateJobNote extends Model
{
	protected $casts = [
		'candidate_job_id' => 'int'
	];

	protected $fillable = [
		'candidate_job_id',
		'note'
	];

	public function candidate_job()
	{
		return $this->belongsTo(\App\Models\CandidateJob::class);
	}
}
