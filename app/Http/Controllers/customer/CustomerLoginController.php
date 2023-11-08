<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Mail\websitemail;
use Hash;
use Auth;


class CustomerLoginController extends Controller
{

    public function login(){
        // ログインビューを表示します
        return view('front.login');
    }
    
    public function login_submit(Request $request){
        // 入力値のバリデーションを行います
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required','min:3']
        ]);
    
        // 認証に使用するクレデンシャルを作成します
        $credential = [
            'email' => $request->email,
            'password' =>$request->password,
            'status' => 1
        ];
    
        // クレデンシャルを使用してユーザーを認証します
        if(Auth::guard('customer')->attempt($credential)){
            // 認証が成功した場合は、顧客用ホームページにリダイレクトします
            return redirect()->route('customer_home');
        } else {
            // 認証が失敗した場合は、ログインページにリダイレクトし、エラーメッセージを表示します
            return redirect()->route('customer_login')->with('error','ログインに失敗しました。');
        }
    }
    

    public function signup(){
        // サインアップビューを表示します
        return view('front.signup');
    }
    
    public function signup_submit(Request $request){
        // 入力値のバリデーションを行います
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:customers'],
            'password' => ['required','min:8'],
            'retype_password' => ['required','same:password'],
        ]);
    
        // トークンを生成します
        $token = hash('sha256',time());
    
        // パスワードをハッシュ化します
        $password = Hash::make($request->password);
    
        // 新しいCustomerオブジェクトを作成し、データベースに保存します
        $obj = new Customer();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = $password;
        $obj->token = $token;
        $obj->status = 1;
        $obj->save();
    
        // ホームページにリダイレクトし、成功メッセージを表示します
        return redirect()->route('home')->with('success','正常にアカウントが登録されました。');
    }
    

    public function forget_password(){
        // パスワード忘れビューを表示します
        return view('front.forget_password');
    }
    
    public function forget_password_submit(Request $request){
        // 入力値のバリデーションを行います
        $request->validate([
            'email' => ['required','email'],
        ]);
    
        // 入力されたメールアドレスを持つCustomerデータを検索します
        $customer_data = Customer::where('email', $request->email)->first();
    
        // 該当する顧客データが存在しない場合はエラーメッセージを表示します
        if(!$customer_data){
            return redirect()->back()->with('error', 'メールアドレスが登録されていません。');
        }
    
        // トークンを生成して、Customerデータに保存します
        $token = hash('sha256',time());
        $customer_data->token = $token;
        $customer_data->update();
    
        // パスワードリセットリンクを作成します
        $reset_link = url('reset-password/'. $token. '/'. $request->email);
    
        // メールの件名と本文を設定し、対象のメールアドレスに送信します
        $subject = 'Reset Password';
        $message = 'Please Click on the following link to reset the password: <br> ';
        $message .= '<a href="'.$reset_link.'">Click here</a>';
        \Mail::to($request->email)->send(new websitemail($subject,$message));
    
        // 顧客ログインページにリダイレクトし、成功メッセージを表示します
        return redirect()->route('customer_login')->with('success', 'メールアドレスにパスワードリセット用のリンク先を送信しました。');
    }
    

    public function logout() {
        // customerの認証をログアウトします
        Auth::guard('customer')->logout();
        
        // 顧客ログインページにリダイレクトします
        return redirect()->route('customer_login');
    }
    
    public function reset_password($token, $email) {
        // 与えられたトークンとメールアドレスを持つCustomerデータを検索します
        $customer_data = Customer::where('token', $token)->where('email', $email)->first();
       
        // 該当する顧客データが存在しない場合は、顧客ログインページにリダイレクトします
        if(!$customer_data){
            return redirect()->route('customer_login');
        }
    
        // パスワードリセットビューを表示します
        return view('front.reset_password',compact('token','email'));
    }
    
    public function reset_password_submit(Request $request){
        // 入力値のバリデーションを行います
        $request->validate([
            'password' => ['required','min:8'],
            'retype_password' => ['required', 'same:password','min:8']
        ]);
       
        // 与えられたトークンとメールアドレスを持つCustomerデータを検索します
        $customer_data = Customer::where('token', $request->token)->where('email', $request->email)->first();
    
        // パスワードをハッシュ化して更新し、トークンを削除します
        $customer_data->password = Hash::make($request->password);
        $customer_data->token = "";
        $customer_data->update();
    
        // 顧客ログインページにリダイレクトし、成功メッセージを表示します
        return redirect()->route('customer_login')->with('success', 'パスワードは正常に更新されました。');
    }
    
}
