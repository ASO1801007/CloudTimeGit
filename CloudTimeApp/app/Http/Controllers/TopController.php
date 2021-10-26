<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Member;
use App\Models\Capsule;
use Auth;

class TopController extends Controller {
    //ログイン後トップ画面
    public function top(){

        //ログインしているユーザーのIDを取得
        $login = Auth::id();

        //ログインしているユーザーIDを取得
        $user_id = User::find($login)->id;
        
        //自分が参加しているカプセル情報を取得
        $member_data = Member::where('user_id',$login)->get();

        // 開ける日付を切り取り文字列化
        $member_data = $this -> open_date_str_system($member_data);

        //変数のままじゃ送れないため、代入
        $data = ["capsule_data"=>$member_data];

        //return
        return view('Top.Top', $data);
    }

    // 開封日のアプリ表示用の値を追加
    private function open_date_str_system($data){
        foreach($data as $i){
            $i->open_date_str = date('Y-n-j',strtotime($i->capsule->open_date));
        }
        return $data;
    }
}
