<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(){
        // Faqモデルを使って、最新の10件のFAQデータをデータベースから取得する
        $faq_all = Faq::orderBy('id','desc')->paginate(10);
        
        // 取得したFAQデータを変数'faq_all'として'front.faq'ビューに渡す
        return view('front.faq',compact('faq_all'));
    }
}
