<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class AdminOrderController extends Controller
{
    public function index(){
        // 注文データを取得します
        $orders = Order::get();
        
        // 'admin.orders'ビューに注文データを渡して表示します
        return view('admin.orders',compact('orders'));
    }

    public function invoice($id) {
        // 指定された注文IDを使用して注文データを取得します
        $order = Order::where('id',$id)->first();
        
        // 注文IDを使用して注文詳細データを取得します
        $order_detail = OrderDetail::where('order_id',$id)->get();
    
        // 注文データに関連付けられた顧客データを取得します
        $customer_data =  Customer::where('id',$order->customer_id)->first();
        
        // 'admin.invoice'ビューに注文データ、注文詳細データ、顧客データを渡して表示します
        return view('admin.invoice',compact('order', 'order_detail','customer_data'));
    }
    public function delete($id){
        // 指定された注文IDを使用して注文を削除します
        Order::where('id', $id)->delete();
    
        // 指定された注文IDを使用して注文詳細を削除します
        OrderDetail::where('order_id', $id)->delete();
    
        // 前のページにリダイレクトし、削除成功のメッセージを表示します
        return redirect()->back()->with('success', '注文情報は正常に削除されました。');
    }
}
