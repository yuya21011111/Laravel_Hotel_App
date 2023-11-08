<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;

class AdminProfileController extends Controller
{
    public function index(){
        return view('admin.profile');
    }
    
    /**
     * プロファイルの送信を処理するメソッド
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function  profile_submit(Request $request){
        // 現在ログインしている管理者の情報を取得
        $admin_data = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    
        // 入力値の検証
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    
        // パスワードの変更がリクエストされた場合の処理
        if($request->password != ""){
            // パスワードと再入力パスワードが一致しているか検証
            $request->validate([
                'password' => ['required'],
                'retype_password' => ['required','same:password'],
            ]);
    
            // 新しいパスワードをハッシュ化して保存
            $admin_data->password = Hash::make($request->password);
        }
    
        // フォトアップロードがリクエストされた場合の処理
        if($request->hasFile('photo')){
            // アップロードされたファイルの検証
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif']
            ]);
    
            // 既存のファイルを削除
            unlink(public_path('uploads/'.$admin_data->photo));
    
            // アップロードされたファイルの拡張子とファイル名を取得
            $ext = $request->file('photo')->extension();
            $file_name = 'admin'. '.'.$ext;
    
            // ファイルをアップロードディレクトリに移動して保存
            $request->file('photo')->move(public_path('uploads/'), $file_name);
            $admin_data->photo = $file_name;
        }
    
        // 入力値を管理者モデルに格納し、データベースを更新
        $admin_data->name = $request->name;
        $admin_data->email = $request->email;
        $admin_data->update();
    
        // プロフィール情報が正常に保存されたことを示すフラッシュメッセージを表示して元のページにリダイレクト
        return redirect()->back()->with('success', 'プロフィール情報を更新しました。');
    }
    
}
