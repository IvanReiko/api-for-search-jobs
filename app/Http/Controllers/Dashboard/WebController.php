<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    protected $redirectTo = '/home';

    public function test(){
        return 'test';
    }
}
