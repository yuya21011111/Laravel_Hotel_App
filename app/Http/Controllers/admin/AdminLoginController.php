<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Mail\websitemail;
use Hash;
use Auth;

class AdminLoginController extends Controller
{
    public function index(){
        

        return view('admin.login');
    }

    public function forget_password(){
        return view('admin.forget_password');
    }

    public function forget_password_submit(Request $request){
        // 入力値の検証
        $request->validate([
            'email' => ['required','email'],
        ]);
    
        // 入力されたメールアドレスを持つ管理者データを検索
        $admin_data = Admin::where('email', $request->email)->first();
    
        // 管理者データが存在しない場合は、エラーメッセージを表示して元のページにリダイレクト
        if(!$admin_data){
            return redirect()->back()->with('error', '存在しないメールアドレスです。');
        }
    
        // リセットトークンの生成とデータベースへの保存
        $token = hash('sha256',time());
        $admin_data->token = $token;
        $admin_data->update();
    
        // リセットパスワード用のリンクを作成しメールで送信
        $reset_link = url('admin/reset-password/'. $token. '/'. $request->email);
        $subject = 'Reset Password';
        $message = 'Please Click on the following link : <br> ';
        $message .= '<a href="'.$reset_link.'">Click here</a>';
        \Mail::to($request->email)->send(new websitemail($subject,$message));
    
        // 成功メッセージを表示して管理者のログインページにリダイレクト
        return redirect()->route('admin_login')->with('success', 'メールアドレスにパスワードリセット用のリンク先を送信しました。');
    }

    public function login_submit(Request $request){
        // 入力値の検証
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required','min:3']
        ]);
    
        // ユーザーの認証情報
        $credential = [
            'email' => $request->email,
            'password' =>$request->password,
        ];
    
        // 認証を試みて成功した場合、管理者ホームページにリダイレクト
        if(Auth::guard('admin')->attempt($credential)){
            return redirect()->route('admin_home');
        } else {
            // 認証に失敗した場合、エラーメッセージを表示して管理者のログインページにリダイレクト
            return redirect()->route('admin_login')->with('error','ログインに失敗しました。');
        }
    }

    public function logout() {
        // 管理者の認証情報を削除します
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function reset_password($token, $email) {
        // トークンとメールアドレスを使用して管理者のデータを検索します
        $admin_data = Admin::where('token', $token)->where('email', $email)->first();
        if(!$admin_data){
            // データが見つからない場合は、管理者のログインページにリダイレクトします
            return redirect()->route('admin_login');
        }
    
        // データが見つかった場合は、パスワードリセットのビューを表示します
        return view('admin.reset_password',compact('token','email'));
    }

    public function reset_password_submit(Request $request){
        // リクエストデータのバリデーションを行います
        $request->validate([
            'password' => ['required'],
            'retype_password' => ['required', 'same:password']
        ]);
    
        // 送信されたトークンとメールアドレスを使用して管理者のデータを検索します
        $admin_data = Admin::where('token', $request->token)->where('email', $request->email)->first();
        
        // パスワードをハッシュ化して更新します
        $admin_data->password = Hash::make($request->password);
        
        // トークンを空にし、管理者のデータを更新します
        $admin_data->token = "";
        $admin_data->update();
    
        // 管理者のログインページにリダイレクトし、成功メッセージを表示します
        return redirect()->route('admin_login')->with('success', 'パスワードは正常にリセットされました。');
    }
}
