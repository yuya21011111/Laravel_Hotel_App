<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index() {
        // Photoモデルから8件ずつページングされた写真データを取得する
        $photo_all = Photo::paginate(8);
        
        // 取得したデータをビューに渡して'front.photo_gallery'ビューを返す
        return view('front.photo_gallery',compact('photo_all'));
    }
}
