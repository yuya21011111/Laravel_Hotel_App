<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
         // 'id'を降順で並べ替えて、データベースからすべての投稿を取得します
        $post_all = Post::orderBy('id','desc')->paginate(9);

        // 取得した投稿を'front.blog'ビューに渡し、変数名を'post_all'として使用できるようにします
        return view('front.blog', compact('post_all'));
    }

    public function single_post($id)
    {
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
