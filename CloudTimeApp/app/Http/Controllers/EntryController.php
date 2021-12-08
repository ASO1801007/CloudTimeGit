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
use Validator;

class EntryController extends Controller
{
    public function show_entry_form($id=0){
        return view('entry.entry_form');
    }

    public function show_invitation($id=0){
        $i_am = Auth::id();

        // 自身が参加しているカプセルのIDを取得
        $my_member = Member::where('user_id',$i_am)->get();
        $my_member_id = array();
        foreach($my_member as $i){
            $my_member_id[] = $i->capsule_id;
        }
        
        // 相手が参加しているカプセルのIDを取得
        $your_member = Member::where('user_id',$id)->get();
        $your_member_id = array();
        foreach($your_member as $i){
            $your_member_id[] = $i->capsule_id;
        }

        $ret_member_id = array_diff($my_member_id, $your_member_id);
        $ret_member_id = array_values($ret_member_id);

        $ret_member = Member::whereIn('capsule_id',$ret_member_id)->get();
        dd($ret_member_id);

        $data = ['member_data' => $ret_member];

        return view('entry.invitation',$data);

    }

    public function entry_select(Request $req){
        $i_am = Auth::id();
        $capsule = Capsule::where('entry_code',$req->entry_code)->get();

        // 検索したカプセルのIDを取得
        $capsule = Capsule::where('entry_code',$req->entry_code)->get();
        $capsule_id = array();
        foreach($capsule as $i){
            $capsule_id[] = $i->id;
        }

        // 自身が参加しているカプセルのIDを取得
        $my_member = Member::where('user_id',$i_am)->get();
        $my_member_id = array();
        foreach($my_member as $i){
            $my_member_id[] = $i->capsule_id;
        }

        $ret_capsule_id = array_diff($capsule_id, $my_member_id);
        $ret_capsule_id = array_values($ret_capsule_id);

        $ret_capsule = Capsule::whereIn('id',$ret_capsule_id)->get();

        if(count($ret_capsule) > 0){
            // 開ける日付を切り取り文字列化
            $ret_capsule = $this -> open_date_str_system($ret_capsule);
            $data = ['search_data' => $ret_capsule];
            dd($ret_capsule);
        }
        else{
            $data = ['search_data' => 0];
        }
        return view('entry.entry_form',$data);
    }

    public function entry_commit(Request $req){
        $i_am = Auth::id();
        $member = new Member;
        $member -> user_id = $i_am;
        $member -> capsule_id = $req -> capsule_id;
        $member -> save();

        return redirect('/top')->with('message','カプセルに参加しました。');
    }

    // 開封日のアプリ表示用の値を追加
    private function open_date_str_system($data){
        foreach($data as $i){
            $i->open_date_str = date('Y-n-j',strtotime($i->open_date));
        }
        return $data;
    }
}
