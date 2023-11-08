<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            SlideSeeder::class,
            FeatureSeeder::class,
            TestimonialSeeder::class,
            PostSeeder::class,
            PhotoSeeder::class,
            VideoSeeder::class,
            FaqSeeder::class,
            PageSeeder::class,
            AmenitiesSeeder::class,
            SettingSeeder::class,
            RoomSeeder::class,
            HotelPhotoSeeder::class,
            CustomerSeeder::class,
        ]);
    }
    
}
