<?php

namespace App\Repositories\Web;

class BaseWebRepository
{
    public function fileDelete($model = false, $attribute = 'url')
    {
        if(!$model){
            return;
        }
        $url = is_object($model) ? $this->getFileNameFromUrl($model->{$attribute}) : $model;
        \Storage::disk('public')->delete($this->getFileNameFromUrl($url));
        if(is_object($model)){
            $model->delete();
        }
        return;
    }

    public function getFileNameFromUrl($url)
    {
        return pathinfo($url, PATHINFO_BASENAME);
    }

    static function prepareLoadRelation($data = [], $prefix = '', $only = false)
    {
        if (empty($data) || empty($prefix)) {
            return $data;
        }
        $data = collect($data)->map(function ($item, $key) use ($prefix) {
            return $prefix . '.' . $item;
        })->all();
        return $only ? $data : array_merge([$prefix], $data);
    }
}