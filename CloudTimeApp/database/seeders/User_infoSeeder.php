<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ver8以降の「DB::」コマンドに必要
use Illuminate\Support\Facades\Hash; // ver8以降の「Hash::」コマンドに必要

class User_infoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $user_infoName = [
            'master',
            '有光勇毅',
            '江崎光',
            '河津翔太',
            '鍬崎颯太',
            '田辺元気',
            '三浦敦志'
        ];

        $user_infoUser_id = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
        ];

        for($i = 0; $i < count($user_infoName); $i++){
            DB::table('user_infos')->insert([
                'name' => $user_infoName[$i],
                'birthday' => '1999-01-01',
                'location' => '福岡',
                'intro' => 'よろしくお願いします！',
                'job' => '新米サラリーマン',
                'high' => '私立希望ヶ峰学園',
                'junior_high' => '稲妻町立雷門中学校',
                'elementary' => '東京都立立川小学校',
                'profile_pic' => 'noImage.png',
                'user_id' => $user_infoUser_id[$i],
                'created_at' => '2021-09-01 00:09:00',
                'updated_at' => '2021-09-01 00:09:00'
            ]);
        }
    }
}
