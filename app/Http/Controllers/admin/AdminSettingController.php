<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function index(){
        
        $setting_data = Setting::where('id',1)->first();
        return view('admin.setting',compact('setting_data'));
    }

    public function update(Request $request){
        $obj = Setting::where('id', 1)->first();

      
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['image', 'mimes:jpg,jpeg,png,gif']
            ]);
            unlink(public_path('uploads/' . $obj->logo));
            $ext = $request->file('logo')->extension();
            $file_name = time() . '.' . $ext;
            $request->file('logo')->move(public_path('uploads/'), $file_name);
            $obj->logo =  $file_name;
        }

        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => ['image', 'mimes:jpg,jpeg,png,gif']
            ]);
            unlink(public_path('uploads/' . $obj->favicon));
            $ext = $request->file('favicon')->extension();
            $file_name = time() . '.' . $ext;
            $request->file('favicon')->move(public_path('uploads/'), $file_name);
            $obj->favicon =  $file_name;
        }

        $obj->top_bar_phone = $request->top_bar_phone;
        $obj->top_bar_email = $request->top_bar_email;
        $obj->home_feature_status = $request->home_feature_status;
        $obj->home_room_total = $request->home_room_total;
        $obj->home_room_status = $request->home_room_status;
        $obj->home_testimonial_status = $request->home_testimonial_status;
        $obj->home_latest_post_total = $request->home_latest_post_total;
        $obj->home_latest_post_status = $request->home_latest_post_status;
        $obj->footer_bar_address = $request->footer_bar_address;
        $obj->footer_bar_phone = $request->footer_bar_phone;
        $obj->footer_bar_email = $request->footer_bar_email;
        $obj->copyright = $request->copyright;
        $obj->facebook = $request->facebook ;
        $obj->twitter = $request->twitter ;
        $obj->github = $request->github;
        $obj->analytic_id = $request->analytic_id;
        $obj->theme_color_1 = $request->theme_color_1;
        $obj->theme_color_2 = $request->theme_color_2;
        $obj->update();
        return redirect()->back()->with('success', '設定は正常に更新されました。');
    }
}
