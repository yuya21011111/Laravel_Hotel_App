<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Hash;


class CustomerProfileController extends Controller
{
    public function index(){
        // `customer.profile` ビューを返します。
        return view('customer.profile');
    }
    
    public function  profile_submit(Request $request){
        // ログインしている顧客のメールアドレスに一致する顧客情報を `Customer` モデルから検索して取得します。
        $customer_data = Customer::where('email', Auth::guard('customer')->user()->email)->first();
    
        // 入力されたデータのバリデーションを行います。
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
           ]);
    
        // もしパスワードが入力されている場合、パスワードと再入力したパスワードが一致するかをチェックします。
        if($request->password != ""){
            $request->validate([
                'password' => ['required'],
                'retype_password' => ['required','same:password'],
               ]);
    
            // 入力されたパスワードをハッシュ化して、顧客情報のパスワードフィールドを更新します。
            $customer_data->password = Hash::make($request->password);
        }
    
        // もし写真がアップロードされた場合、アップロードされた写真のバリデーションを行います。
        if($request->hasFile('photo')){
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif']
               ]);
    
            // もし以前に写真が設定されていた場合、その写真を削除します。
            if (trim($customer_data->photo) !== '' || $customer_data->photo !== null){
                unlink(public_path('uploads/'.$customer_data->photo));
            }
    
            // アップロードされた写真を保存します。ファイル名は現在の時間と拡張子から生成します。
            $ext = $request->file('photo')->extension();
            $file_name = time() . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $file_name);
    
            // 顧客情報の写真フィールドを更新します。
            $customer_data->photo = $file_name;
        }
    
        // 入力された情報を顧客情報の各フィールドに更新します。
        $customer_data->name = $request->name;
        $customer_data->email = $request->email;
        $customer_data->phone = $request->phone;
        $customer_data->country = $request->country;
        $customer_data->address = $request->address;
        $customer_data->state = $request->state;
        $customer_data->city = $request->city;
        $customer_data->zip = $request->zip;
    
        // 顧客情報をデータベースに保存します。
        $customer_data->update();
    
        // プロフィール情報が正常に保存されたことを示す成功メッセージを表示しながら、元のページにリダイレクトします。
        return redirect()->back()->with('success', 'プロフィール情報は正常に更新されました。');
    }
    
}
