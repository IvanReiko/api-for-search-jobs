<?php

namespace App\Http\Controllers\Api;

class IndexController extends ApiController
{
    public function apiVersion()
    {
        //TODO:version
        return $this->respondContent('1.0.8');
    }
}
