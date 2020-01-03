<?php

namespace App\Repositories\Api;


class BaseApiRepository
{
    public function parametersPaginate($request)
    {
        if($request->all){
            $request->per_page = 999999;
        }
        return [
            'page'     => $request->page ? $request->page : 1,
            'per_page' => $request->per_page ? $request->per_page : 15,
            'filter'   => $request->filter ? $request->filter : false,
        ];
    }

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
        if(empty($data) || empty($prefix)){
            return $data;
        }
        $data = collect($data)->map(function ($item, $key) use ($prefix){
            return $prefix.'.'.$item;
        })->all();
        return $only ? $data : array_merge([$prefix], $data);
    }
}