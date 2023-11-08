<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class TermsController extends Controller
{
    public function index(){
        // PageモデルからIDが1のページデータを取得する
        $page = Page::where('id',1)->first();
        
        // 取得したデータをビューに渡して'front.terms'ビューを返す
        return view('front.terms',compact('page'));
    }
}
