<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailConfirmation
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property bool $is_confirmed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\User $user
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailConfirmation whereUserId($value)
 */
class EmailConfirmation extends Model
{
	protected $casts = [
		'user_id' => 'int',
		'is_confirmed' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'hash',
		'is_confirmed'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}
