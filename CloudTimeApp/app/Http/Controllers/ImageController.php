<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Capsule;
use App\Models\User_info;
use App\Models\Bbs;
use App\Models\Member;
use Auth;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ImageController extends Controller
{
    //画像保存
    public function index(Request $data)
    {
        $capsule_id = $data->capsule_id;
        $images = Image::where('capsule_id',$capsule_id)->get();
        $open_date = Capsule::find($capsule_id)->open_date;
        $ret_data = 0;
        date_default_timezone_set('Asia/Tokyo');
        $now_date = date('Y-m-d H:i:s');
        if($now_date >= $open_date){
            $ret_data = 1;
        }
        return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data]);
    }

    public function store(Request $request)
    {
        $rulus = [
            'image' => 'required',
        ];

        $message = [
            'image.required' => '画像を選択してください,'
        ];

        $validator = Validator::make($request->all(), $rulus, $message);

        if($validator->fails()){
            return view('error.error_page')
            ->withErrors($validator);
        }
        
        $image = new Image();
        $uploadImg = $image->image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $uploadImg, 'public');
        $image->image = Storage::disk('s3')->url($path);
        $image->capsule_id = $request->capsule_id;
        $image->save();

        //CapusuleControllerからコピペ
        $i_am = Auth::id();
        $i_am_info = User_info::find($i_am);
        $capsule = Capsule::find($request->capsule_id);
        $admin_flag = $this -> admin_flag_system($capsule->user_id);//管理者判定
        $open_flag = $this -> open_flag_system($capsule->open_date);//開封日判定
        $member_flag = $this -> member_flag_system($capsule->id);//メンバー判定
        if($member_flag == 0){
            return view('error.error_page');
        }
        $capsule->open_date_str = date('Y月-n日-j日',strtotime($capsule->open_date));
        $data = ['open_flag'=>$open_flag, 'admin_flag'=>$admin_flag, 'capsule_data'=>$capsule];
        return view('capsule.capsule_info',$data)->with('message','思い出を追加したよ！');
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

    //開封
    
}
