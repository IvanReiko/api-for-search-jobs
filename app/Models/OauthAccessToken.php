<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OauthAccessToken
 *
 * @property string $id
 * @property int $user_id
 * @property int $client_id
 * @property string $name
 * @property string $scopes
 * @property bool $revoked
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $expires_at
 * @property \App\User $user
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthAccessToken whereUserId($value)
 */
class OauthAccessToken extends Model
{
    public $incrementing = false;

    protected $casts = [
        'user_id' => 'int',
        'client_id' => 'int',
        'revoked' => 'bool'
    ];

    protected $dates = [
        'expires_at'
    ];

    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'scopes',
        'revoked',
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
