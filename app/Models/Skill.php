<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Skill
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property int $skill_category_id
 * @property \App\Models\SkillCategory $skill_category
 * @property \Illuminate\Database\Eloquent\Collection $candidates
 * @property \Illuminate\Database\Eloquent\Collection $jobs
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill whereSkillCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill whereWeight($value)
 */
class Skill extends Model
{
	public $timestamps = false;

	protected $casts = [
		'weight' => 'int',
		'skill_category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'weight',
		'skill_category_id'
	];

	public function skill_category()
	{
		return $this->belongsTo(\App\Models\SkillCategory::class);
	}

	public function candidates()
	{
		return $this->belongsToMany(\App\Models\Candidate::class);
	}

	public function jobs()
	{
		return $this->belongsToMany(\App\Models\Job::class);
	}
}
