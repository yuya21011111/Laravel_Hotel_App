<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'photo' => 'sample1.png',
                'heading' => 'test',
                'short_content' => 'test',
                'content' => 'test',
                'total_view' => 0,
            
            ],
            [
                'photo' => 'sample2.png',
                'heading' => 'test',
                'short_content' => 'test',
                'content' => 'test',
                'total_view' => 0,
            
            ],
            [
                'photo' => 'sample3.png',
                'heading' => 'test',
                'short_content' => 'test',
                'content' => 'test',
                'total_view' => 0,      
            ],
        ]);
   }
}