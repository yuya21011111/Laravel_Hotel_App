<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('photos')->insert([
            [
                'photo' => 'room1.png',
                'caption' => 'test',
            ],
            [
                'photo' => 'room2.png',
                'caption' => 'test',
            ],
        ]);
    }
}
