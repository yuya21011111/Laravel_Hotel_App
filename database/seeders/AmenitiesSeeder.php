<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('amenities')->insert([
            [
                'name' => '歯ブラシ・歯磨き粉',
            ],
            [
                'name' => 'シャンプー',
            ],
            [
                'name' => 'コンディショナー',
            ],
            [
                'name' => 'ボディーソープ',
            ],
            [
                'name' => 'ヘアブラシ',
            ],
            [
                'name' => 'バスタオル',
            ],
            [
                'name' => 'バスマット',
            ],
            [
                'name' => '館内着',
            ],
            [
                'name' => 'スリッパ',
            ],

        ]);
    }
}
