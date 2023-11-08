<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class CustomerOrderController extends Controller
{
    public function index(){
        // `Order` モデルから、ログインしている顧客のIDと一致するレコードを取得します。
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->get();
        
        // `customer.orders` ビューに、取得したオーダーの情報を渡してビューを返します。
        return view('customer.orders',compact('orders'));
    }
    
    public function invoice($id) {
        // 指定された ID に一致するオーダーを `Order` モデルから検索して取得します。
        $order = Order::where('id',$id)->first();
    
        // 指定された ID に一致するオーダー詳細を `OrderDetail` モデルから検索して取得します。
        $order_detail = OrderDetail::where('order_id',$id)->get();
        
        // `customer.invoice` ビューに、取得したオーダーとオーダー詳細の情報を渡してビューを返します。
        return view('customer.invoice',compact('order', 'order_detail'));
    }
    
}
