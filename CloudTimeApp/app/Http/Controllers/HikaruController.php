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

class HikaruController extends Controller{

    // 畳の話
    public function UnitConversion($param=0){
        $name = "UnitConversion";
        $ret_data = "";
        if($param <= -129){
            $ret_data = "Exception occurred,under -129";
        }else if($param > -129 && $param < 1){
            $ret_data = "畳数は1以上を入力してください";
        }else if($param >= 1 && $param <= 127){
            $param = $param * 1.65;
            $ret_data = $param;
        }else if($param > 127){
            $ret_data = "Exception occurred,under 128";
        }
        $data = [ 'name' => $name, 'ret_data',$ret_data ];
        return view('hikaru.show_test');
    }

}
