<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ver8以降の「DB::」コマンドに必要

class BbsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('bbss')->insert([
            'bbs_body' => '江崎光 さんがタイムカプセル「null」を作成されました！この掲示板ではメンバー同士で会話することができます！また、誰かがタイムカプセルに思い出を追加した際にはこの掲示板に通知されます。なお、どんな思い出を入れたのかは表示されません。',
            'user_id' => '2',
            'capsule_id' => '1'
        ]);
    }
}
