<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($capsule_id) {
        $data = [ 'capsule_id' => $capsule_id ];

        return view('chat.newchat',$data); // フォームページのビュー
    }

    // public function view(){
    //     return view('chat.chat');
    // }

    // public function view2(){
    //     return view('chat.chat2');
    // }

    // public function view3(){
    //     return view('chat.chat3');
    // }
}
