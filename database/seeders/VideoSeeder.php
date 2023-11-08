<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            [
                'video_id' => 'Lf8wAoERQ3M',
                'caption' => 'test',
            ],
            [
                'video_id' => 'CnoGg5bw4hQ',
                'caption' => 'test',
            ],
        ]);
    }
}
