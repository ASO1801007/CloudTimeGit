<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ver8以降の「DB::」コマンドに必要

class CapsuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('capsules')->insert([
            'name' => '希望が峰学園',
            'open_date' => '2041-12-31',
            'thumbnail' => 'noImage.png',
            'intro' => '希望が峰学園のズッ友あつまれー！',
            'entry_code' => '000000',
            'user_id' => '2',
            'created_at' => '2021-09-01 00:09:00',
            'updated_at' => '2021-09-01 00:09:00'
        ]);
    }
}
