<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 10 ; $i++) {

            \App\Models\Message::create([
                'message' => $i .'番目のテキスト'
            ]);
        }
        Message::create([
            'capsule_id' => "1",
            'message' => "チャットを始めよう",
            'comment_user' => "1",
        ]);
    }
}
