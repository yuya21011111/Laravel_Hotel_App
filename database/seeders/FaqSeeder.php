<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'question' => 'Q チェックイン・チェックアウトの時間について',
                'answer' => 'チェックインは、15：00から、チェックアウトは、10：00までとなります。
                ※宿泊プランによって異なる場合がございます。',
            ],
            [
                'question' => 'Q ご宿泊チェックイン場所について
                ',
                'answer' => '本館、新館のご予約にかかわらず、本館4Fフロントでのお手続きとなります。',
            ],
        ]);
    }
}
