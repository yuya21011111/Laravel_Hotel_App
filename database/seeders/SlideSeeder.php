<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slides')->insert([
            [
                'photo' => 'sample1.png',
                'heading' => 'test',
                'text' => 'test',
                'button_text' => 'test',
                'button_url' => 'https://github.com/yuya21011111?tab=repositories',

            ],
            [
                'photo' => 'sample2.png',
                'heading' => 'test',
                'text' => 'test',
                'button_text' => 'test',
                'button_url' => 'https://github.com/yuya21011111?tab=repositories',

            ],
            [
                'photo' => 'sample3.png',
                'heading' => 'test',
                'text' => 'test',
                'button_text' => 'test',
                'button_url' => 'https://github.com/yuya21011111?tab=repositories',
            ],
        ]);
    }
}
