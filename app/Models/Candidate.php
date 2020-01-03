<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Candidate
 *
 * @property int $id
 * @property int $user_id
 * @property int $city_id
 * @property string $hash_name
 * @property string $full_name
 * @property string $email
 * @property string $photo_url
 * @property string $phone_number
 * @property int $salary_min
 * @property int $salary_max
 * @property int $experience_years_min
 * @property int $experience_years_max
 * @property bool $is_published
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\City $city
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $candidate_educations
 * @property \Illuminate\Database\Eloquent\Collection $employment_levels
 * @property \Illuminate\Database\Eloquent\Collection $employment_types
 * @property \Illuminate\Database\Eloquent\Collection $filter_cities
 * @property \Illuminate\Database\Eloquent\Collection $candidate_documents
 * @property \Illuminate\Database\Eloquent\Collection $industries
 * @property \Illuminate\Database\Eloquent\Collection $candidate_invites
 * @property \Illuminate\Database\Eloquent\Collection $job_roles
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @property \Illuminate\Database\Eloquent\Collection $candidate_language_skills
 * @property \Illuminate\Database\Eloquent\Collection $candidate_setting
 * @property \Illuminate\Database\Eloquent\Collection $skills
 * @property \Illuminate\Database\Eloquent\Collection $candidate_work_experiences
 * @property \Illuminate\Database\Eloquent\Collection $messages
 * @property \Illuminate\Database\Eloquent\Collection $recruiters
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate published()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereExperienceYearsMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereExperienceYearsMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereHashName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereSalaryMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereSalaryMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Candidate whereEmail($value)
 */
class Candidate extends Model
{
    public $timestamps = false;

    protected $casts = [
        'user_id' => 'int',
        'city_id' => 'int',
        'salary_min' => 'int',
        'salary_max' => 'int',
        'experience_years_min' => 'int',
        'experience_years_max' => 'int',
        'is_published' => 'bool'
    ];


    protected $fillable = [
        'user_id',
        'city_id',
        'hash_name',
        'full_name',
        'email',
        'photo_url',
        'phone_number',
        'salary_min',
        'salary_max',
        'experience_years_min',
        'experience_years_max'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }

    public function filter_cities()
    {
        return $this->belongsToMany(\App\Models\City::class, 'candidate_filter_city');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function candidate_educations()
    {
        return $this->hasMany(\App\Models\CandidateEducation::class);
    }

    public function employment_levels()
    {
        return $this->belongsToMany(\App\Models\EmploymentLevel::class);
    }

    public function employment_types()
    {
        return $this->belongsToMany(\App\Models\EmploymentType::class);
    }

    public function candidate_documents()
    {
        return $this->hasMany(\App\Models\CandidateDocument::class);
    }

    public function industries()
    {
        return $this->belongsToMany(\App\Models\Industry::class);
    }

    public function candidate_invites()
    {
        return $this->hasMany(\App\Models\CandidateInvite::class);
    }

    public function job_roles()
    {
        return $this->belongsToMany(\App\Models\JobRole::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(\App\Models\Job::class, 'candidate_jobs');
    }

    public function candidate_language_skills()
    {
        return $this->hasMany(\App\Models\CandidateLanguageSkill::class);
    }

    public function candidate_setting()
    {
        return $this->hasOne(\App\Models\CandidateSetting::class);
    }

    public function skills()
    {
        return $this->belongsToMany(\App\Models\Skill::class);
    }

    public function candidate_work_experiences()
    {
        return $this->hasMany(\App\Models\CandidateWorkExperience::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    public function recruiters()
    {
        return $this->belongsToMany(\App\Models\Recruiter::class, 'recruiter_wishlist_candidate');
    }
}
