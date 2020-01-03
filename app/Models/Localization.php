<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Localization
 *
 * @property string $language_id
 * @property int $weight
 * @property \App\Models\Language $language
 * @package App\Models
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Localization whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Localization whereWeight($value)
 */
class Localization extends Model
{
    protected $primaryKey = 'language_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'weight' => 'int'
    ];

    protected $fillable = [
        'language_id',
        'weight',
    ];

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class);
    }
}
