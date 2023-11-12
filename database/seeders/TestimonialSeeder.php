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
                'photo' => 'user1.png',
                'name' => 'ジョン・ドウ',
                'designation' => '無職',
                'comment' => 'とてもいいホテルです。',
            ],
            [
                'photo' => 'user2.png',
                'name' => 'ジョン・ドウ',
                'designation' => '無職',
                'comment' => 'とてもいいホテルです。',
            ],
        ]);
    }
}
