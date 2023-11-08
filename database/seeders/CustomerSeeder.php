<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => '山田太郎',
                'email' => 'test1@test.com',
                'password' => Hash::make('password123'),
                'phone' => '080-xxxx-xxxx',
                'zip' => '100-0000',
                'city' => '日本',
                'state' => '香川県',
                'address' => '高松市',
                'country' => '高松町xxx-xxx-xxx',
                'photo' => 'default.png',
                'status' => 1,
            ],
            [
                'name' => '鈴木太郎',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'phone' => '090-xxxx-xxxx',
                'zip' => '200-0000',
                'city' => '日本',
                'state' => '香川県',
                'address' => '観音寺市',
                'country' => '観音寺町xxx-xxx-xxx',
                'photo' => 'default.png',
                'status' => 1,
            ],
        ]);
    }
}
