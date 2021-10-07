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

class CapsuleController extends Controller{

    //カプセル新規作成画面
    public function show_entry($id=0){
        return view('capsule.capsule_entry');
    }


    // カプセル作成ボタン押下時
    public function capsule_create(Request $req){
        $rulus = [
            'name' => 'required',
            'thumbnail' => 'required',
            'open_date' => 'required'
        ];

        $message = [
            'name.required' => 'カプセル名を入力してください',
            'thumbnail.required' => 'サムネイルを選択してください',
            'open_date.required' => '開封日を入力してください（例 2000-01-11）'
        ];

        $validator = Validator::make($req->all(), $rulus, $message);

        if($validator->fails()){
            return redirect('/capsule_entry')
            ->withErrors($validator);
        }
        $this -> capsule_grand_create_system($req);
        $data = $this -> show_top();
        return redirect('/top');
    }


    //カプセルホーム画面
    public function show_info($id=0){
        //ログインしているユーザーのIDを取得
        $i_am = Auth::id();

        //ログインしているユーザーIDを取得
        $i_am_info = User_info::find($i_am);

        $capsule = Capsule::find($id);

        // 管理人フラグ判定の関数呼び出し
        $admin_flag = $this -> admin_flag_system($capsule->user_id);

        // 開封日フラグ判定の関数呼び出し
        $open_flag = $this -> open_flag_system($capsule->open_date);

        // 参加者フラグ判定の関数呼び出し
        $member_flag = $this -> member_flag_system($capsule->id);

        if($member_flag == 0){
            return view('error.error_page');
        }

        // 開ける日付を切り取り文字列化
        $capsule->open_date_str = date('Y-n-j',strtotime($capsule->open_date));

        $data = ['open_flag'=>$open_flag, 'admin_flag'=>$admin_flag, 'capsuleRow'=>$capsule];
        return view('capsule.capsule_info',$data);
    }

    // カプセル作成時の各テーブルへのアクション
    private function capsule_grand_create_system($req){
        $i_am = Auth::id();
        $capsule_id = $this -> capsule_insert_system($req,$i_am);
        $this -> member_insert_system(1,$capsule_id);
        $this -> member_insert_system($i_am,$capsule_id);
        // $start_message_data = make_start_message_data_system($capsule_id);
        // ここに chat_insert_system()(マスターメッセージ)が入る
    }

    // カプセルテーブル挿入システム(作成したカプセルのIDを返す)
    private function capsule_insert_system($req,$i_am){
        $capsule = new Capsule;
        $capsule = $this -> capsule_formdata_cast_system($req,$i_am,$capsule);
        $capsule -> save();
        $new_data = Capsule::orderBy("updated_at","desc")->take(1)->get();
        return $new_data[0]->id;
    }

    // カプセル作成時のフォームデータを挿入できる形式に変換するシステム
    private function capsule_formdata_cast_system($req,$i_am,$capsule){
        $capsule -> name = $req -> name;
        $capsule -> open_date = $req -> open_date;
        $uploadImg = $capsule-> thumbnail = $req->file('thumbnail');
        $path = Storage::disk('s3')->putFile('/', $uploadImg, 'public');
        $capsule->thumbnail = Storage::disk('s3')->url($path);
        $capsule -> intro = $req -> intro;
        $capsule -> entry_code = $this -> make_entry_code_system();
        $capsule -> user_id = $i_am;
        return $capsule;
    }

    // 招待コード生成システム
    private function make_entry_code_system(){
        $ret_data = 
            chr(mt_rand(65,90)) . chr(mt_rand(65,90)) .
            chr(mt_rand(65,90)) . chr(mt_rand(65,90)) .
            chr(mt_rand(65,90)) . chr(mt_rand(65,90));
            // 65~90は大文字英字
        return $ret_data;
    }

    // メンバーテーブル挿入システム
    private function member_insert_system($who,$capsule_id){
        $member = new Member;
        $member -> user_id = $who;
        $member -> capsule_id = $capsule_id;
        $member -> save();
    }

    // チャットテーブル挿入システム
    private function chat_insert_system(){
        return 0;
    }



    // 管理人フラグ判定の関数
    private function admin_flag_system($capsule_user_id){
        $ret_data = 0;
        $i_am = Auth::id();
        // 作成者を偽装するスイッチ(test)
        // $i_am = 2; 
        if($i_am == $capsule_user_id){
            $ret_data = 1;
        }
        return $ret_data;
    }

    // 開封日フラグ判定の関数
    private function open_flag_system($capsule_open_date){
        $ret_data = 0;
        date_default_timezone_set('Asia/Tokyo');
        $now_date = date('Y-m-d H:i:s');
        if($now_date >= $capsule_open_date){
            $ret_data = 1;
        }
        return $ret_data;
    }

    // メンバーフラグ判定の関数
    private function member_flag_system($capsule_id){
        $ret_data = 0;
        $i_am = Auth::id();

        $member_data = Member::where([
            ['user_id',$i_am],
            ['capsule_id',$capsule_id]
        ])->get();
        if(count($member_data) > 0){
            $ret_data = 1;
        }
        return $ret_data;

    }

    //元気ページ
    private function show_top(){
        //ログインしているユーザーのIDを取得
        $login = Auth::id();

        //ログインしているユーザーIDを取得
        $user_id = User::find($login)->id;
        
        //自分が参加しているカプセル情報を取得
        $join_capsule_id = Member::where('user_id',$login)->get();
        $count = count($join_capsule_id);

        //変数のままじゃ送れないため、代入
        $data = ["capsule_data"=>$join_capsule_id, "count"=>$count];
        return $data;
    }
}
