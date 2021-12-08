<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($capsule_id) {
        $data = [ 'capsule_id' => $capsule_id ];

        return view('chat.chat',$data); // フォームページのビュー
    
    }

    public function view(){
        return view('chat.chat');
    }
}
