<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LogStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogStatus whereName($value)
 */
class LogStatus extends Model
{
    const ADD_NOTE = 1;
    const EDIT_NOTE = 2;
    const APPROVE_CANDIDATE = 3;
    const DISAPPROVE_CANDIDATE = 4;
    const ADD_TO_WISHLIST = 5;

	public $timestamps = false;

    protected $casts = [
        'id' => 'int'
    ];

	protected $fillable = [
		'id',
		'name'
	];

	public function jobs()
	{
		return $this->belongsToMany(\App\Models\Job::class);
	}
}
