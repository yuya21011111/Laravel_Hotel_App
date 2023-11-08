<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class HotelPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotel_photos')->insert([
            [
                'room_id' => 1,
                'photo' => 'sample1.png',
            ],
            [
                'room_id' => 1,
                'photo' => 'sample1.png',
            ],
            [
                'room_id' => 2,
                'photo' => 'sample2.png',
            ],
            [
                'room_id' => 2,
                'photo' => 'sample2.png',
            ],
        ]);
    }
}
