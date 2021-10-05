<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller{
    public function mypage($id=0){
        return view('mypage');
    }
}