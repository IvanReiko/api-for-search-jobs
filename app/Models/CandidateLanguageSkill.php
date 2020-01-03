<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateLanguageSkill
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $language_id
 * @property int $language_level_speaking_id
 * @property int $language_level_writing_id
 * @property \App\Models\Candidate $candidate
 * @property \App\Models\LanguageLevel $language_level_speaking
 * @property \App\Models\LanguageLevel $llanguage_level_writing
 * @property \App\Models\Language $language
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateLanguageSkill whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateLanguageSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateLanguageSkill whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateLanguageSkill whereLanguageLevelSpeakingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateLanguageSkill whereLanguageLevelWritingId($value)
 * @property-read \App\Models\LanguageLevel $language_level_writing
 */
class CandidateLanguageSkill extends Model
{
    public $timestamps = false;

    protected $casts = [
        'candidate_id' => 'int',
        'language_level_speaking_id' => 'int',
        'language_level_writing_id' => 'int'
    ];

    protected $fillable = [
        'candidate_id',
        'language_id',
        'language_level_speaking_id',
        'language_level_writing_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(\App\Models\Candidate::class);
    }

    public function language_level_speaking()
    {
        return $this->belongsTo(\App\Models\LanguageLevel::class, 'language_level_speaking_id');
    }

    public function language_level_writing()
    {
        return $this->belongsTo(\App\Models\LanguageLevel::class, 'language_level_writing_id');
    }

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class);
    }
}
