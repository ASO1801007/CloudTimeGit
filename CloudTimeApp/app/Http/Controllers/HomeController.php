<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Member;
use App\Models\Capsule;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //ログインしているユーザーのIDを取得
        $login = Auth::id();

        //ログインしているユーザーIDを取得
        $user_id = User::find($login)->id;
        
        //自分が参加しているカプセル情報を取得
        $join_capsule_id = Member::where('user_id',$login)->get();
        $count = count($join_capsule_id);
        
        //変数のままじゃ送れないため、代入
        $data = ["capsule_data"=>$join_capsule_id, "count"=>$count];

        //return
        return view('Top.Top', $data);

        // return view('Top.top');
    }
}