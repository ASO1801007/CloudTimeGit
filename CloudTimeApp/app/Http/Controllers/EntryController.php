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
        $my_capsule = Capsule::find($i_am);
        $your_capsule = Capsule::find($id);
    }

    public function entry_select(Request $req){
        $capsule = Capsule::where('entry_code',$req->entry_code)->get();
        if(count($capsule) > 0){
            // 開ける日付を切り取り文字列化
            $capsule = $this -> open_date_str_system($capsule);
            $data = ['search_data' => $capsule];
            return view('entry.entry_form',$data);
        }
        else{
            return view('entry.entry_form')->with('message','一致するカプセルはありませんでした。');
        }
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
