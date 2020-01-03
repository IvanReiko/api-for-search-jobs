<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateEducation
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $field_of_study
 * @property string $degree
 * @property string $school_name
 * @property string $final_grade
 * @property string $school_website_url
 * @property string $description
 * @property \Carbon\Carbon $started_at
 * @property \Carbon\Carbon $ended_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\Candidate $candidate
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereFieldOfStudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereFinalGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereUpdatedAt($value)
 */
class CandidateEducation extends Model
{
	protected $casts = [
		'candidate_id' => 'int',
        'started_at' => 'date_format:Y-m-d',
        'ended_at' => 'date_format:Y-m-d',
	];

    protected $dates = [
        'started_at',
        'ended_at'
    ];

	protected $fillable = [
		'candidate_id',
		'field_of_study',
		'degree',
		'school_name',
		'final_grade',
		'description',
		'school_website_url',
		'started_at',
		'ended_at',
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}
}
