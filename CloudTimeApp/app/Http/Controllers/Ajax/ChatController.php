<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Message;
use App\Models\User;
use Auth;
use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public $public_capsule_id;
    public function index(Request $request) {// capsule_idごとにメッセージを取得

        $capsule_id = $request->capsule_id;
        $message = Message::where('capsule_id',$capsule_id) -> orderBy('id', 'asc')->get();
        //ログインしているユーザーのIDを取得
        $login = Auth::id();

        //ログインしているユーザーIDを取得
        $user_id = User::find($login)->id;
        $a=0;
        //コメントした人の名前を取得
        foreach($message as $messages){
            $comment_user_id = $messages['comment_user'];
            $comment_user = User::where('id',$comment_user_id) -> get();
            $message[$a] -> user_name = $comment_user[0] -> name;
            // file_put_contents("test.txt", var_export($message, true));
            if($user_id == $comment_user_id){
                $me_or_you = 1;//コメントしたユーザーは自分
            }else{
                $me_or_you = 0;//コメントしたユーザーは自分以外
            }
            $message[$a] -> me_or_you = $me_or_you;
            $a+=1;
        }

        file_put_contents("test.txt", var_export($message, true));

        return $message;
    }

    public function create(Request $request) { // メッセージを登録

        //   public/text.txtに受け取ったデータを転記
        //file_put_contents("test.txt", var_export($request['message'], true));
        // $x = var_export($request['params.message'], true);
        // $y = var_export($request['params.capsule_id'], true);

        $message = $request['message'];
        // file_put_contents("test.txt", var_export($message, true));
        $capsule_id = $request['capsule_id'];
        //ログインしているユーザーのIDを取得
        $i_am = Auth::id();
        //ログインしているユーザーIDを取得
        $i_user_id = User::find($i_am)->id;
        //file_put_contents("test.txt", var_export($message, true));
        $message = Message::create([
            'comment_user' => $i_user_id,
            'capsule_id' => $capsule_id,
            'message' => $message,
        ]);
        event(new MessageCreated($message));
    }
}
