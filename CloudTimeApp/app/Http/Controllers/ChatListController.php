<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Capsule;
use App\Models\User_info;
use App\Models\Bbs;
use App\Models\Member;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChatListController extends Controller
{
    public function chat_list(){

        //ログインしているユーザーのIDを取得
        $login = Auth::id();

        //ログインしているユーザーIDを取得
        $user_id = User::find($login)->id;

        //自分が参加しているカプセル情報を取得
        $member_data = Member::where('user_id',$login)->get();

        $count=0;
        //自分が参加しているカプセルの最初のチャットを取得
        $first_chat = array();
        foreach($member_data as $capsule) {
            $capsule_id = $capsule->capsule_id;
            $first_chat[] = Message::where('capsule_id',$capsule_id)->orderBy('id','desc')->first();
        }
        // dd($first_chat);
        $a=0;
        //変数のままじゃ送れないため、代入
        $data = ["capsule_data"=>$member_data, "first_chat"=>$first_chat, "a"=>$a];
        return view('chat.chatlist',$data);
    }
}
