<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereName($value)
 */
class UserRole extends Model
{
    const ADMIN = 1;
    const RECRUITER = 2;
    const CANDIDATE = 3;

	public $timestamps = false;

    protected $casts = [
        'id' => 'int'
    ];

	protected $fillable = [
		'id',
		'name'
	];

	public function users()
	{
		return $this->belongsToMany(\App\User::class, 'user_role_user');
	}
}
