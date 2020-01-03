<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CandidateSetting
 *
 * @property int $id
 * @property int $candidate_id
 * @property bool $is_notification_for_new_job
 * @property bool $is_notification_for_new_message
 * @property bool $is_notification_for_new_match
 * @property bool $is_receive_email_for_new_job
 * @property bool $is_receive_email_for_new_message
 * @property bool $is_receive_email_for_new_match
 * @property string $google_token
 * @property string $linkedin_token
 * @property string $fcm_token
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\Candidate $candidate
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereFcmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereGoogleToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsNotificationForNewJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsNotificationForNewMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsNotificationForNewMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsReceiveEmailForNewJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsReceiveEmailForNewMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereIsReceiveEmailForNewMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereLinkedinToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateSetting whereUpdatedAt($value)
 */
class CandidateSetting extends Model
{
	public $timestamps = false;

	protected $casts = [
		'candidate_id' => 'int',
		'is_notification_for_new_job' => 'bool',
		'is_notification_for_new_message' => 'bool',
		'is_notification_for_new_match' => 'bool',
		'is_receive_email_for_new_job' => 'bool',
		'is_receive_email_for_new_message' => 'bool',
		'is_receive_email_for_new_match' => 'bool'
	];

	/*protected $hidden = [
		'google_token',
		'linkedin_token',
		'fcm_token'
	];*/

	protected $fillable = [
		'candidate_id',
		'is_notification_for_new_job',
		'is_notification_for_new_message',
		'is_notification_for_new_match',
		'is_receive_email_for_new_job',
		'is_receive_email_for_new_message',
		'is_receive_email_for_new_match',
		'google_token',
		'linkedin_token',
		'fcm_token'
	];

	public function candidate()
	{
		return $this->belongsTo(\App\Models\Candidate::class);
	}
}
