<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Capsule;
use App\Models\User_info;
use App\Models\Bbs;
use App\Models\Member;
use Auth;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller{

    // 表示画面
    public function show_info($id=0){
        $i_am = Auth::id();
        $user = User::find($id);

        // 開くページが自身のページかを判定
        $i_am_flag = $this -> i_am_flag_system($i_am,$id);

        $data = ['user_data' => $user, 'i_am_flag' => $i_am_flag];

        return view('mypage.mypage_info',$data);
    }

    // 編集画面
    public function show_edit($id=0){
        $i_am = Auth::id();
        $user = User::find($i_am);

        $data = ['user_data' => $user];

        return view('mypage.mypage_edit',$data);
    }

    // ユーザーテーブル更新処理
    public function mypage_update(Request $req){
        $i_am = Auth::id();
        $this -> user_update_system($i_am,$req);
        return redirect()->route('mypage.show_info', ['user_id' => $i_am]);
    }

    private function user_update_system($user_id,$req){
        $user = User::find($user_id);
        $uploadImg = $user -> profile_pic = $req->file('profile_pic');
        $path = Storage::disk('s3')->putFile('/', $uploadImg, 'public');
        $user->profile_pic = Storage::disk('s3')->url($path);
        $user -> name = $req -> name;
        $user -> email = $req -> email;
        $user -> birthday = $req -> birthday;
        $user -> intro = $req -> intro;
        $user -> location = $req -> location;
        $user -> job = $req -> job;
        $user -> high = $req -> high;
        $user -> junior_high = $req -> junior_high;
        $user -> elementary = $req -> elementary;
        $user -> save();
    }

    private function i_am_flag_system($my_id,$url_id){
        $ret_data = 0;
        if($my_id == $url_id){
            $ret_data = 1;
        }
        return $ret_data;
    }
}