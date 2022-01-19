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

class MemberController extends Controller{

    // メンバー画面表示
    public function show_member_list($id=0){
        $member = Member::where('capsule_id',$id)->orderBy('created_at')->get();
        $data = ['member_data' => $member];
        return view('member.member_list',$data);
    }

    // メンバー直接招待機能
    public function member_update(Request $req){
        if(isset($req->user_id)){
            foreach($req->user_id as $i){
                $member = new Member;
                $member -> user_id = $i;
                $member -> capsule_id = $req -> capsule_id;
                $member -> save();
                return redirect()->route('capsule.show_info', ['capsule_id' => $req -> capsule_id])->with('message','メンバーを'.count($req->user_id).'名追加しました');
            }
        }else{
            return redirect()->route('capsule.show_info', ['capsule_id' => $req -> capsule_id])->with('message','メンバーを追加しませんでした。');
        }
    }

    // メンバー直接招待画面表示
    public function show_member_add_select($id=0){
        $i_am = Auth::id();
        $capsule = Capsule::find($id);

        //自身の参加しているカプセルを選出
        $member = Member::where('user_id',$i_am)->get();
        $member_id = array();
        foreach($member as $i){
            $member_id[] = $i->capsule_id;
        }

        //自身の参加しているカプセルに参加しているメンバーを選出
        $friend_list = Member::whereIn('capsule_id',$member_id)->get();

        // 重複したUSER_IDを除いた配列を作成
        $unq_count = array();
        $unq_count[] = $i_am;
        foreach($friend_list as $i){
            $unq_count[] = $i->user_id;
        }
        $unq_count = array_unique($unq_count);

        // 配列から自分とマスターを除外
        $ex = [1,$i_am];
        $unq_count = array_diff($unq_count, $ex);

        // すでに参加中のメンバーのIDを取得
        $black_list = Member::where('capsule_id',$id)->get();
        $blask_list_id = array();
        foreach($black_list as $i){
            $blask_list_id[] = $i->user_id;
        }

        // 招待リストを作成
        $friend_list2 = User::whereIn('id',$unq_count)->whereNotIn('id',$blask_list_id)->get();

        $data = ['user_data' => $friend_list2, 'capsule_data' => $capsule];
        return view('member.member_add_select',$data);
    }
    

    // リストから自身と重複したメンバーを削除
    private function member_add_select_system($friend_list,$i_am){
        $ret_data = array();
        $unq_count = array();
        $unq_count[] = $i_am;
        $death_flag = 0;
        for($i = count($friend_list); $i >= 0; $i--){
            for($j = 1; $j < count($unq_count); $j++){
                if($friend_list[$i]->user_id == $unq_count[$j]){
                    $unq_count[] = $friend_list[$i]->user_id;
                    unset($friend_list[$i]);
                }
            }
        }
        array_values($friend_list);
        return $friend_list;
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