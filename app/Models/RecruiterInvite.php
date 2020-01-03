<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecruiterInvite
 *
 * @property int $id
 * @property int $recruiter_id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $hash
 * @property string $position
 * @property \Carbon\Carbon $created_at
 * @property \App\Models\Recruiter $recruiter
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RecruiterInvite whereRecruiterId($value)
 */
class RecruiterInvite extends Model
{
	public $timestamps = false;

	protected $casts = [
		'recruiter_id' => 'int'
	];

	protected $fillable = [
		'recruiter_id',
		'email',
		'first_name',
		'last_name',
		'hash',
		'position'
	];

	public function recruiter()
	{
		return $this->belongsTo(\App\Models\Recruiter::class);
	}
}
