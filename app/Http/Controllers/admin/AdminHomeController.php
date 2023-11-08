<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Room;


class AdminHomeController extends Controller
{
    public function index() {
        // 注文データを最新の5件だけ取得します（新しいものから順に）
        $orders = Order::orderBy('id','desc')->skip(0)->take(5)->get();
        
        // ステータスが 'Completed' の注文の総数を取得します
        $total_completed_orders = Order::where('status','Completed')->count();
        
        // ステータスが 'Pending' の注文の総数を取得します
        $total_pending_orders = Order::where('status','Pending')->count();
        
        // ステータスが 1（アクティブ）の顧客の総数を取得します
        $total_active_customers = Customer::where('status',1)->count();
        
        // ステータスが 0（保留中）の顧客の総数を取得します
        $total_pending_customers = Customer::where('status',0)->count();
        
        // 部屋の総数を取得します
        $total_rooms = Room::count();
        
        // 'admin.home'ビューに注文データや顧客データの統計情報を渡して表示します
        return view('admin.home',compact('orders','total_completed_orders','total_pending_orders','total_active_customers','total_pending_customers','total_rooms'));
    }
}
