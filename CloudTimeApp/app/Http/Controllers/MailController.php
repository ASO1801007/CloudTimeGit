<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Capsule;
use App\Models\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function sendmail()
    {
        $auth = auth::id();

        $capsules_id = DB::table('members')
            ->where('user_id', $auth)
            ->get();
        //dd($capsules_id);
        $my_cap = DB::table('capsules')
            ->get();

        //一週間前に通知
        $nowtime = date('Y/m/d H:i:s',strtotime("+1 week"));
        $a = 0;
        //dd($my_cap[0]->open_date);
        foreach ($my_cap as $data) {
            $open_day = $data->open_date;
            if ($nowtime >= $open_day) {
                //メール処理
                $user_name = User::find($auth)->name;
                $user_email = User::find($auth)->email;
                // テキストメール送信
                $mail_subject = "もうすぐでカプセルが開きます!!!";
                $mail_content = "もうすぐでカプセルが開きます!楽しみですね!\n" .
                    env('APP_URL');
                $email = User::find($auth)->email;
                //dd($email);
                $from_email = env('MAIL_FROM_ADDRESS');
                $from_name = "Cloud Time Capsule";
                \Mail::send([], [], function ($message) use ($from_email, $from_name, $mail_subject, $mail_content, $email) {
                    $message->to($email);
                    $message->subject($mail_subject);
                    $message->setBody($mail_content);
                });
            }
        }
    }

    public function testmail()
    {
        $auth = auth::id();
        $user_name = User::find($auth)->name;
        $user_email = User::find($auth)->email;
        // テキストメール送信
        $mail_subject = "もうすぐでカプセルが開きます!!!（test）";
        $mail_content = "$user_name" . "さんお久しぶりです!\nもうすぐでカプセルが開きます!楽しみですね!\n" .
            env('APP_URL');
        $email = User::find($auth)->email;
        $from_email = env('MAIL_FROM_ADDRESS');
        $from_name = "Cloud Time Capsule";
        \Mail::send([], [], function ($message) use ($from_email, $from_name, $mail_subject, $mail_content, $email) {
            $message->to($email);
            $message->subject($mail_subject);
            $message->setBody($mail_content);
        });
        dd($auth);
    }
}
