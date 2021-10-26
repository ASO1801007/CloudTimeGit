<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Capsule;
use App\Models\User_info;
use App\Models\Bbs;
use App\Models\Member;
use Auth;
use strcmp;
use Illuminate\Support\Facades\Storage;
use Validator;

class MypageController extends Controller{

    // 表示画面
    public function show_info($id=0){
        $i_am = Auth::id();
        if($id == 0){
            $user = User::find($i_am);
        }else if($id > 0){
            $user = User::find($id);
        }

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
        $user = User::find($i_am);
        $data = ['user_data' => $user];
        $rulus = [
        
            'name' => 'required',
        ];

        $message = [
           
            'name.required' => '名前を入力してください',
        ];

        $validator = Validator::make($req->all(), $rulus, $message);

        if($validator->fails()){
            return view('mypage.mypage_edit',$data)
            ->withErrors($validator);
        }
        $this -> user_update_system($i_am,$req);
        return redirect()->route('mypage.show_info', ['user_id' => $i_am])->with('message','編集しました');
    }

    private function user_update_system($user_id,$req){
        $user = User::find($user_id);
        if($req->image != null){
            if( strcmp( $user->profile_pic, "0" ) != 0 ){
                $delete_path = basename($user->profile_pic);
                $delete_path = str_replace('https://example.s3-ap-northeast-1.amazonaws.com/', '', $delete_path);
                $disk = Storage::disk('s3');
                $disk->delete($delete_path);
            };
            $uploadImg = $user -> profile_pic = $req->file('image');
            $path = Storage::disk('s3')->putFile('/', $uploadImg, 'public');
            $user->profile_pic = Storage::disk('s3')->url($path);
        };
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
        if($my_id == $url_id or 0 == $url_id){
            $ret_data = 1;
        }
        return $ret_data;
    }
}