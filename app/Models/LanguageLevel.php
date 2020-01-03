<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LanguageLevel
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property \Illuminate\Database\Eloquent\Collection $candidate_language_level_speaking
 * @property \Illuminate\Database\Eloquent\Collection $candidate_language_level_writing
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LanguageLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LanguageLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LanguageLevel whereWeight($value)
 */
class LanguageLevel extends Model
{
    const BEGINNER = 1;
    const INTERMEDIATE = 2;
    const ADVANCED = 3;

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'weight' => 'int'
	];

	protected $fillable = [
		'id',
		'name',
		'weight'
	];

    public function candidate_language_level_speaking()
    {
        return $this->hasMany(\App\Models\CandidateLanguageSkill::class, 'language_level_speaking_id');
    }

	public function candidate_language_level_writing()
	{
		return $this->hasMany(\App\Models\CandidateLanguageSkill::class, 'language_level_writing_id');
	}
}
