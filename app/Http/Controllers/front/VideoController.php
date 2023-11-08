<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index() {
        // Videoモデルから4つのビデオを1ページに表示するように、ページネーションされたすべてのビデオのリストを取得します。
        $video_all = Video::paginate(4);
        
        // 取得したビデオは 'front.video_gallery' ビューに渡され、レンダリングされます。
        return view('front.video_gallery',compact('video_all'));
    }
}
