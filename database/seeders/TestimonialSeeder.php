<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'photo' => 'sample1.png',
                'name' => 'JunDo',
                'designation' => 'CA',
                'comment' => 'test',
            ],
            [
                'photo' => 'sample2.png',
                'name' => 'KaiDou',
                'designation' => 'CIO',
                'comment' => 'test',
            ],
        ]);
    }
}
