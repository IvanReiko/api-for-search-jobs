<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property int $id
 * @property int $job_id
 * @property int $candidate_id
 * @property int $recruiter_id
 * @property int $sender_id
 * @property int $company_id
 * @property int $from_user_id
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \App\Models\Candidate $candidate
 * @property \App\Models\Job $job
 * @property \App\Models\Recruiter $recruiters
 * @property \App\User $sender
 * @property \App\Models\Company $company
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMessage($value)
 */
class Message extends Model
{
	public $timestamps = false;

	protected $casts = [
		'job_id' => 'int',
		'candidate_id' => 'int',
		'recruiter_id' => 'int',
		'sender_id' => 'int',
		'company_id' => 'int',
	];

	protected $fillable = [
		'job_id',
		'candidate_id',
		'recruiter_id',
		'sender_id',
		'company_id',
		'message'
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}

	public function job()
	{
		return $this->belongsTo(\App\Models\Job::class);
	}

    public function recruiters()
    {
        return $this->belongsTo(\App\Models\Recruiter::class);
    }

    public function sender()
    {
        return $this->belongsTo(\App\User::class);
    }


    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
