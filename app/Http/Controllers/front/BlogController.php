<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    
    public function single_post($id){
        // `Post` モデルから、指定された `id` に一致する投稿を検索して取得します。
        $single_post_data = Post::where('id', $id)->first();
    
        // 取得した投稿の `total_view` プロパティの値を1増やします。
        $single_post_data->total_view = $single_post_data->total_view + 1;
    
        // 変更を保存します。
        $single_post_data->update();
    
        // `front.post` ビューに、`single_post_data` 変数を渡してビューを返します。
        return view('front.post', compact('single_post_data'));
    }
    
}
