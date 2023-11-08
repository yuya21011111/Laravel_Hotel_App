<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Feature;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Room;

class HomeController extends Controller
{
    public function index(){
        // Slideモデルからすべてのスライドデータを取得する
        $slide_all = Slide::all();
        
        // Featureモデルからすべての特集データを取得する
        $feature_all = Feature::all();
        
        // Testimonialモデルからすべてのお客様の声データを取得する
        $testimonial_all = Testimonial::all();
        
        // Postモデルから最新の3件のデータを取得する
        $post_all = Post::orderBy('id', 'desc')->limit(3)->get();
        
        // Roomモデルからすべての部屋データを取得する
        $room_all = Room::get();
    
        // 取得したデータをビューに渡して'front.home'ビューを返す
        return view('front.home',compact('slide_all' ,'feature_all', 'testimonial_all', 'post_all', 'room_all'));
    }
}
