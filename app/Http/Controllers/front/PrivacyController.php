<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PrivacyController extends Controller
{
    public function index(){
        // idが1のページデータをPageモデルから取得する
        $page = Page::where('id',1)->first();
        
        // 取得したデータをビューに渡して'front.privacy'ビューを返す
        return view('front.privacy',compact('page'));
    }
}
