<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SkillCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $skills
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SkillCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SkillCategory whereName($value)
 */
class SkillCategory extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function skills()
	{
		return $this->hasMany(\App\Models\Skill::class);
	}
}
