<?php

namespace App\Transformers;

class BaseResponseTransformer
{
    static function baseLists($data, $withAttributes = [])
    {
        return $data->map(function ($model) use ($withAttributes) {
            return self::base($model, $withAttributes);
        });
    }

    static function base($data, $withAttributes = [])
    {
        $attributes = [
            'id',
            'name'
        ];
        return collect($data)->only(array_merge($attributes, $withAttributes))->all();
    }

    static function languages($data)
    {
        return $data->map(function ($model) {
            return self::base($model, ['native_name']);
        });
    }

    static function cities($data)
    {
        return $data->map(function ($model) {
            return self::city($model);
        });
    }

    static function city($data)
    {
        if(empty($data)){
            return $data;
        }
        $data = (object)$data;
        return [
            'id' => $data->id,
            'name' => $data->name,
            'country' => self::base($data->country),
        ];
    }
}