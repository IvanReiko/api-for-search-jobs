<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateInvite
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $email
 * @property string $hash
 * @property \Carbon\Carbon $created_at
 * @property \App\Models\Candidate $candidate
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateInvite whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateInvite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateInvite whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateInvite whereId($value)
 */
class CandidateInvite extends Model
{
	public $timestamps = false;

	protected $casts = [
		'candidate_id' => 'int'
	];

	protected $fillable = [
		'candidate_id',
		'email',
		'hash'
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}
}
