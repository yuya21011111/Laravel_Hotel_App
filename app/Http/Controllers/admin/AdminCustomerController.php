<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class AdminCustomerController extends Controller
{
    public function index(){

        $customers = Customer::get();
        return view('admin.customer',compact('customers'));
    }

    public function change_status($id){
        $customer_data = Customer::where('id',$id)->first();
        if($customer_data->status == 1) {
            $customer_data->status = 0;
        }
        else {
            $customer_data->status = 1;
        }
        $customer_data->update();
        return redirect()->back()->with('success', '顧客情報は正常に更新されました。');
    }
}
