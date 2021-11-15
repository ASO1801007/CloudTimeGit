<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Capsule;
use App\Models\User_info;
use App\Models\Bbs;
use App\Models\Member;
use Auth;
use App\Models\Img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class ImageController extends Controller
{
    //開封ボタン押下後
    public function index(Request $data)
    {
        $capsule_id = $data->capsule_id;
        $images = Img::where('capsule_id',$capsule_id)->get();
        $open_date = Capsule::find($capsule_id)->open_date;
        if(Capsule::find($capsule_id)->lat != null){
            $lat1 = Capsule::find($capsule_id)->lat;
            $lng1 = Capsule::find($capsule_id)->lng;
            $lat2 = $data->lat;
            $lng2 = $data->lng;
            //２地点間の距離
            $a = 6378137.00000; 
            $b = 6356752.314245; 
            $e2 = ( pow( $a, 2) - pow( $b, 2)) / pow( $a, 2);
            $x1 = deg2rad( $lng1 );
            $y1 = deg2rad( $lat1 );
            $x2 = deg2rad( $lng2 );
            $y2 = deg2rad( $lat2 );
            $dy = $y1 - $y2;
            $dx = $x1 - $x2;
            $mu_y = ( $y1 + $y2 ) / 2.0;
            $W = sqrt( 1.0 - ( $e2 * pow( sin( $mu_y ), 2 )));
            $N = $a / $W;
            $M = ( $a * ( 1 - $e2 )) / pow( $W, 3 );
            $d = sqrt( pow( $dy * $M, 2 ) + pow( $dx * $N * cos( $mu_y ), 2 ));
            $ret_data = 0;
            date_default_timezone_set('Asia/Tokyo');
            $now_date = date('Y-m-d H:i:s');
            if($now_date >= $open_date){
            $ret_data = 1;
            }
            if($d<=500){
                $genzaiti = 1;
                return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data, 'genzaiti'=>$genzaiti]);
            }else{
                $genzaiti = 0;
                return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data, 'genzaiti'=>$genzaiti]);
            }
        }
        $ret_data = 0;
        date_default_timezone_set('Asia/Tokyo');
        $now_date = date('Y-m-d H:i:s');
        if($now_date >= $open_date){
            $ret_data = 1;
        }
        $genzaiti = 0;
        return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data, 'genzaiti'=>$genzaiti]);
    }

    public function hantei(Request $data)
    {
        $capsule_id = $data->capsule_id;
        $images = Img::where('capsule_id',$capsule_id)->get();
        $open_date = Capsule::find($capsule_id)->open_date;
        $lat1 = Capsule::find($capsule_id)->lat;
        $lng1 = Capsule::find($capsule_id)->lng;
        $ret_data = 0;
        $lat2 = $data->lat;
        $lng2 = $data->lng;

        //２地点間の距離
        $a = 6378137.00000; 
        $b = 6356752.314245; 
        $e2 = ( pow( $a, 2) - pow( $b, 2)) / pow( $a, 2);
        $x1 = deg2rad( $lng1 );
        $y1 = deg2rad( $lat1 );
        $x2 = deg2rad( $lng2 );
        $y2 = deg2rad( $lat2 );
        $dy = $y1 - $y2;
        $dx = $x1 - $x2;
        $mu_y = ( $y1 + $y2 ) / 2.0;
        $W = sqrt( 1.0 - ( $e2 * pow( sin( $mu_y ), 2 )));
        $N = $a / $W;
        $M = ( $a * ( 1 - $e2 )) / pow( $W, 3 );
        $d = sqrt( pow( $dy * $M, 2 ) + pow( $dx * $N * cos( $mu_y ), 2 ));

        date_default_timezone_set('Asia/Tokyo');
        $now_date = date('Y-m-d H:i:s');
        if($now_date >= $open_date){
            $ret_data = 1;
        }

        if($d <= 700){
            $genzaiti = 1;
            return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data, 'genzaiti'=>$genzaiti]);
        }else{
            return view('image.index', ['images'=>$images, 'capsule_id'=>$capsule_id, 'open_flg'=>$ret_data]);
        }
    }

    //画像保存処理
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
        
        $image = new Img();
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
}
