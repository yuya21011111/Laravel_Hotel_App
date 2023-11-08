<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class ContactController extends Controller
{
    public function index(){
        // IDが1であるページデータをPageモデルから取得する
        $page = Page::where('id',1)->first();
        
        // 取得したページデータを変数'page'として'front.contact'ビューに渡す
        return view('front.contact',compact('page'));
    }
}
