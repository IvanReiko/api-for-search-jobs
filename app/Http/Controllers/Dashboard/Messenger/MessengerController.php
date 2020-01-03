<?php

namespace App\Http\Controllers\Dashboard\Messenger;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessengerController extends Controller
{
    public function index(){
//        $messages = Message::with('candidate', 'job')->get();
        return view('messenger.index'/*, compact('messages')*/);
    }
}
