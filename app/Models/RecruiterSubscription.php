<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecruiterSubscription
 *
 * @property int $id
 * @property int $recruiter_id
 * @property int $subscription_id
 * @property int $subscription_status_id
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon $created_at
 * @property \App\Models\Recruiter $recruiter
 * @property \App\Models\SubscriptionStatus $subscription_status
 * @property \App\Models\Subscription $subscription
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereRecruiterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterSubscription whereSubscriptionStatusId($value)
 */
class RecruiterSubscription extends Model
{
	public $timestamps = false;

	protected $casts = [
		'recruiter_id' => 'int',
		'subscription_id' => 'int',
		'subscription_status_id' => 'int'
	];

	protected $dates = [
		'expires_at'
	];

	protected $fillable = [
		'recruiter_id',
		'subscription_id',
		'subscription_status_id',
		'expires_at'
	];

	public function recruiter()
	{
		return $this->belongsTo(\App\Models\Recruiter::class);
	}

	public function subscription_status()
	{
		return $this->belongsTo(\App\Models\SubscriptionStatus::class);
	}

	public function subscription()
	{
		return $this->belongsTo(\App\Models\Subscription::class);
	}
}
