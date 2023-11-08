<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'featured_photo' => 'sample1.png',
                'name' => 'カジュアルルーム',
                'description' => 'リーズナブルで低層階のお部屋です。',
                'price' => '8000',
                'total_rooms' => '3',
                'amenities' => '1,2,3',
                'size' => '28m2',
                'total_beds' => '2',
                'total_bathrooms' => '1',
                'total_balconies' => '0',
                'total_guests' => '3',
                'video_id' => 'CnoGg5bw4hQ',
            ],
            [
                'featured_photo' => 'sample2.png',
                'name' => 'バルコニールーム',
                'description' => 'バルコニーが自慢のお部屋です。',
                'price' => '10000',
                'total_rooms' => '3',
                'amenities' => '1,2,3',
                'size' => '32m2',
                'total_beds' => '2',
                'total_bathrooms' => '1',
                'total_balconies' => '1',
                'total_guests' => '3',
                'video_id' => 'CnoGg5bw4hQ',
            ],
        ]);
    }
}
