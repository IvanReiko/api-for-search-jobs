<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recruiter
 *
 * @property int $id
 * @property int $recruiter_team_id
 * @property int $user_id
 * @property int $company_id
 * @property string $language_id
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property string $photo_url
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\Company $company
 * @property \App\Models\Language $language
 * @property \App\Models\Recruiter $team_recruiter
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @property \Illuminate\Database\Eloquent\Collection $recruiter_invites
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $team_recruiters
 * @property \Illuminate\Database\Eloquent\Collection $messages
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereRecruiterTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recruiter whereUserId($value)
 */
class Recruiter extends Model
{
    public $timestamps = false;

    protected $casts = [
        'recruiter_team_id' => 'int',
        'user_id' => 'int',
        'company_id' => 'int'
    ];

    protected $fillable = [
        'recruiter_team_id',
        'user_id',
        'company_id',
        'language_id',
        'first_name',
        'last_name',
        'position',
        'photo_url'
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class);
    }

    public function team_recruiter()
    {
        return $this->belongsTo(\App\Models\Recruiter::class, 'recruiter_team_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function jobs()
    {
        return $this->hasMany(\App\Models\Job::class);
    }

    public function recruiter_invites()
    {
        return $this->hasMany(\App\Models\RecruiterInvite::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(\App\Models\Subscription::class, 'recruiter_subscriptions')
            ->withPivot('id', 'subscription_status_id', 'expires_at');
    }

    public function candidates()
    {
        return $this->belongsToMany(\App\Models\Candidate::class, 'recruiter_wishlist_candidate');
    }

    public function team_recruiters()
    {
        return $this->hasMany(\App\Models\Recruiter::class, 'recruiter_team_id');
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }
}
