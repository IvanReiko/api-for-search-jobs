<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobStatus whereName($value)
 */
class JobStatus extends Model
{
    const ACTIVE = 1;
    const DRAFT = 2;
    const ARCHIVE = 3;

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
		return $this->hasMany(\App\Models\Job::class);
	}
}
