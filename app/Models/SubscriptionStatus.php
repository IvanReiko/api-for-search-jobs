<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $recruiter_subscriptions
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionStatus whereName($value)
 */
class SubscriptionStatus extends Model
{
    const ACTIVE = 1;
    const EXPIRED = 2;

	public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'weight' => 'int'
    ];

	protected $fillable = [
		'id',
		'name'
	];

	public function recruiter_subscriptions()
	{
		return $this->hasMany(\App\Models\RecruiterSubscription::class);
	}
}
