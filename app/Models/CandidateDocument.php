<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateDocument
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $name
 * @property string $url
 * @property string $type
 * @property int $size
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\Candidate $candidate
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateDocument whereUrl($value)
 */
class CandidateDocument extends Model
{
	protected $casts = [
		'candidate_id' => 'int',
		'size' => 'int'
	];

	protected $fillable = [
		'candidate_id',
		'name',
		'url',
		'type',
		'size'
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}
}
