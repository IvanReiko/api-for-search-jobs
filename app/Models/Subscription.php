<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property bool $is_regular_payment
 * @property int $expires
 * @property \Illuminate\Database\Eloquent\Collection $recruiters
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereIsRegularPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereTitle($value)
 */
class Subscription extends Model
{
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
        'is_regular_payment' => 'bool',
		'expires' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'price',
		'is_regular_payment',
		'expires'
	];

	public function recruiters()
	{
		return $this->belongsToMany(\App\Models\Recruiter::class)
					->withPivot('id', 'subscription_status_id', 'expires_at');
	}
}
