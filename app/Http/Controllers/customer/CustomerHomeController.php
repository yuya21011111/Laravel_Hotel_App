<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class CustomerHomeController extends Controller
{
    public function index() {
        // 現在ログインしている顧客の完了した注文の数をカウントする
        $total_completed_orders = Order::where('status','Completed')->where('customer_id',Auth::guard('customer')->user()->id)->count();
        
        // 現在ログインしている顧客の保留中の注文の数をカウントする
        $total_pending_orders = Order::where('status','Pending')->where('customer_id',Auth::guard('customer')->user()->id)->count();
        
        // カウント結果を変数としてcustomer.homeビューに渡し、それを返す
        return view('customer.home',compact('total_completed_orders','total_pending_orders'));
    }
    
}
