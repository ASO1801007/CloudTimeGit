<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    public function sendmail()
    {   
        $auth=auth::id();
        $cap_id = DB::table('members')
        ->where('user_id', $auth)
        ->get();
        dd($cap_id);
        foreach($cap_id as $capsule_id){
            $my_cap = DB::table('members')
            ->where('id', $capsule_id)
            ->get();
        }

        dd($my_cap);
        //一週間前に通知
        $sendday = date("Y-m-d", strtotime("+7 day"));

        foreach ($my_cap as $data) {
            if ($sendday == $data()->open_date) {
                //メール処理
                $entry_data = Application::latest()->first();
                $job_id = $entry_data->job_id;
                $job_owner_id = Joboffer::find($job_id)->user_id;
                $job_owner_name = Joboffer::find($job_id)->name;
                $job_owner_address = Joboffer::find($job_id)->address;
                $job_owner_working_status = Joboffer::find($job_id)->working_status;
                $job_owner_salary = Joboffer::find($job_id)->salary;
                $job_owner_details = Joboffer::find($job_id)->details;

                $user_name = User::find($auth)->name;
                $user_email = User::find($auth)->email;
                $user_kana = User_data::find($auth)->kananame;
                $user_address = User_data::find($auth)->address;
                $user_appealpoint = User_data::find($auth)->appealpoint;
                $entry_data = Application::latest()->first();
                // テキストメール送信
                $mail_subject = "もうすぐでカプセルが開きます!!!";
                $mail_content = "もうすぐでカプセルが開きます!楽しみですね!\n" .
                    env('APP_URL');
                $email = User::find($job_owner_id)->email;
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
}
