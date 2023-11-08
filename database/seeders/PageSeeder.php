<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'about_heading' => 'About',
                'about_content' => 'About Test',
                'about_status' => 1,
                'terms_heading' => 'Term',
                'terms_content' => 'term Test',
                'terms_status' => 1,
                'privacy_heading' => 'Privacy',
                'privacy_content' => 'Privacy Test',
                'privacy_status' => 1,
                'contact_heading' => 'Contact',
                'contact_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3294.359634283878!2d134.04401507602952!3d34.34132417304952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3553eb90d0809a9d%3A0x65bacec5a2915b4e!2z6auY5p2-5biC56uL5Lit5aSu5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1699040354800!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'contact_status' => 1,
                'photo_gallery_heading' => 'Photo_Gallery',
                'photo_gallery_status' => 1,
                'video_gallery_heading' => 'video_Gallery',
                'video_gallery_status' => 1,
                'faq_heading' => 'FAQ',
                'faq_status' => 1,
                'blog_heading' => 'Blog',
                'blog_status' => 1,
                'room_heading' => 'Room',
                'cart_heading' => 'Cart',
                'cart_status' => 1,
                'checkout_heading' => 'Checkout',
                'checkout_status' => 1,
                'payment_heading' => 'Payment',
                'signup_heading' => 'Signup',
                'signup_status' => 1,
                'signin_heading' => 'Signin',
                'signin_status' => 1,
                'forget_password_heading' => 'Forget_password',
                'reset_password_heading' => 'Reset_password_heading',
            ],
        ]);
    }
}
