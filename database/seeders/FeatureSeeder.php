<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'icon' => 'fa fa-clock-o',
                'heading' => '24 hour Room service',
                'text' => 'test',
            ],
            [
                'icon' => 'fa fa-wifi',
                'heading' => 'Free Wifi',
                'text' => 'test',
            ],
            [
                'icon' => 'fa fa-superpowers',
                'heading' => 'Enjoy Free Nights',
                'text' => 'test',
            ],
            [
                'icon' => 'fa fa-cubes',
                'heading' => 'test',
                'text' => 'test',
            ],
            [
                'icon' => 'fa fa-facebook',
                'heading' => 'test',
                'text' => 'test',
            ],
        ]);
    }
}
