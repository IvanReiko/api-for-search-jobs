<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateWorkExperience
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $position
 * @property string $company_name
 * @property string $company_website_url
 * @property string $description
 * @property \Carbon\Carbon $started_at
 * @property \Carbon\Carbon $ended_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\Candidate $candidate
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereCompanyWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateWorkExperience whereUpdatedAt($value)
 */
class CandidateWorkExperience extends Model
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
		'position',
		'company_name',
		'company_website_url',
		'description',
		'started_at',
		'ended_at'
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}
}
