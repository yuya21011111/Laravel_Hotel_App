<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class AboutController extends Controller
{
    public function index(){
        // `Page` モデルから、idが1に一致するページを検索して取得します。
        $page = Page::where('id',1)->first();
    
        // `front.about` ビューに、`page` 変数を渡してビューを返します。
        return view('front.about',compact('page'));
    }
    
}
