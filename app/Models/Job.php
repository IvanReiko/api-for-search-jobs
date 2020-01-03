<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 *
 * @property int $id
 * @property int $job_role_id
 * @property int $job_status_id
 * @property int $employment_level_id
 * @property int $employment_type_id
 * @property int $industry_id
 * @property int $company_id
 * @property int $recruiter_id
 * @property int $experience_years_min
 * @property int $experience_years_max
 * @property int $salary_min
 * @property int $salary_max
 * @property string $description
 * @property string $company_name
 * @property string $address
 * @property string $offer_url
 * @property \Carbon\Carbon $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $employment_levels
 * @property \Illuminate\Database\Eloquent\Collection $employment_types
 * @property \App\Models\Industry $industry
 * @property \App\Models\Company $company
 * @property \App\Models\JobRole $job_role
 * @property \App\Models\JobStatus $job_status
 * @property \App\Models\Recruiter $recruiter
 * @property \App\Models\City $city
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $languages
 * @property \Illuminate\Database\Eloquent\Collection $log_statuses
 * @property \Illuminate\Database\Eloquent\Collection $skills
 * @property \Illuminate\Database\Eloquent\Collection $messages
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereEmploymentLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereEmploymentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereExperienceYearsMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereExperienceYearsMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereIndustryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereJobRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereJobStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereOfferUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereRecruiterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereSalaryMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereSalaryMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job archive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Job draft()
 */
class Job extends Model
{
	protected $casts = [
		'job_role_id' => 'int',
		'job_status_id' => 'int',
		'industry_id' => 'int',
        'company_id' => 'int',
		'recruiter_id' => 'int',
        'city_id' => 'int',
		'experience_years_min' => 'int',
		'experience_years_max' => 'int',
		'salary_min' => 'int',
		'salary_max' => 'int'
	];

	protected $dates = [
		'published_at'
	];

	protected $fillable = [
		'job_role_id',
		'job_status_id',
		'industry_id',
        'company_id',
		'recruiter_id',
        'city_id',
		'company_name',
		'address',
		'experience_years_min',
		'experience_years_max',
		'salary_min',
		'salary_max',
		'description',
		'offer_url',
		'published_at'
	];

    public function scopeActive($query)
    {
        return $query->where('job_status_id', JobStatus::ACTIVE);
    }

    public function scopeDraft($query)
    {
        return $query->where('job_status_id', JobStatus::DRAFT);
    }

    public function scopeArchive($query)
    {
        return $query->where('job_status_id', JobStatus::ARCHIVE);
    }

    public function employment_levels()
    {
        return $this->belongsToMany(\App\Models\EmploymentLevel::class);
    }

    public function employment_types()
    {
        return $this->belongsToMany(\App\Models\EmploymentType::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

	public function industry()
	{
		return $this->belongsTo(\App\Models\Industry::class);
	}

	public function job_role()
	{
		return $this->belongsTo(\App\Models\JobRole::class);
	}

	public function job_status()
	{
		return $this->belongsTo(\App\Models\JobStatus::class);
	}

	public function recruiter()
	{
		return $this->belongsTo(\App\Models\Recruiter::class);
	}

	public function candidates()
	{
		return $this->belongsToMany(\App\Models\Candidate::class, 'candidate_jobs');
	}

	public function languages()
	{
		return $this->belongsToMany(\App\Models\Language::class);
	}

	public function log_statuses()
	{
		return $this->belongsToMany(\App\Models\LogStatus::class);
	}

	public function skills()
	{
		return $this->belongsToMany(\App\Models\Skill::class);
	}

	public function messages()
	{
		return $this->hasMany(\App\Models\Message::class);
	}

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }
}
