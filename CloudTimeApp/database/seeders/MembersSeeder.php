<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ver8以降の「DB::」コマンドに必要

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $memberUser_id = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
        ];

        for($i = 0; $i < count($memberUser_id); $i++){
            DB::table('members')->insert([
                'user_id' => $memberUser_id[$i],
                'capsule_id' => '1'
            ]);
        }
    }
}
