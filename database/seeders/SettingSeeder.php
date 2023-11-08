<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'logo' => 'logo.png',
                'favicon' => 'favicon.png',
                'top_bar_phone' => '0120-xxxx-xxxx',
                'top_bar_email' => 'hotel@xxx.com',
                'home_feature_status' => 'Show',
                'home_room_total' => '4',
                'home_room_status' => 'Show',
                'home_testimonial_status' => 'Show',
                'home_latest_post_total' => '3',
                'home_latest_post_status' => 'Show',
                'footer_bar_address' => 'address',
                'footer_bar_phone' => '0120-xxxx-xxxx',
                'footer_bar_email' => 'hotel@xxx.com',
                'copyright' => '©️ Green 2024',
                'facebook' => 'https://www.facebook.com/campaign/landing.php?campaign_id=1665596389&extra_1=s%7Cc%7C321610682052%7Ce%7Cfacebook%7C&placement=&creative=321610682052&keyword=facebook&partner_id=googlesem&extra_2=campaignid%3D1665596389%26adgroupid%3D65075436220%26matchtype%3De%26network%3Dg%26source%3Dnotmobile%26search_or_content%3Ds%26device%3Dc%26devicemodel%3D%26adposition%3D%26target%3D%26targetid%3Dkwd-541132862%26loc_physical_ms%3D1009540%26loc_interest_ms%3D%26feeditemid%3D%26param1%3D%26param2%3D&gclid=CjwKCAjw15eqBhBZEiwAbDomEk8lUZwtJJ4i8s0gIhleiRBQs277iadmfZRCBCTxQnaZa8AFdBTPXhoCVB8QAvD_BwE',
                'twitter' => 'https://twitter.com/?lang=ja',
                'github' => 'https://github.com/yuya21011111',
                'theme_color_1' => '#07f7d7',
                'theme_color_2' => '#05b39b',
                'analytic_id' => 'G-YCMW8LZD4Y',
            ],
        ]);
    }
}
