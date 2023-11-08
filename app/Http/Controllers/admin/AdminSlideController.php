<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class AdminSlideController extends Controller
{
    public function index()
    {
        // スライドのデータを取得
        $slides = Slide::get();
        
        // 'slides'という変数名でスライドビューにデータを渡して表示
        return view('admin.slide_view', compact('slides'));
    }
    
    public function add()
    {
        // スライド追加ビューを表示
        return view('admin.slide_add');
    }
    
    public function store(Request $request)
    {
        // 入力値の検証
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        // 画像ファイルをアップロードディレクトリに保存
        $ext = $request->file('photo')->extension();
        $file_name = time() . '.' . $ext;
        $request->file('photo')->move(public_path('uploads/'), $file_name);
    
        // スライドモデルのインスタンスを作成し、データを保存
        $obj = new Slide();
        $obj->photo = $file_name;
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        $obj->save();
    
        // 元のページにリダイレクトして成功メッセージを表示
        return redirect()->back()->with('success', 'Slide is saved successfully.');
    }
    
    public function edit($id)
    {
        // 編集するスライドのデータを取得
        $slide_data = Slide::find($id);
    
        // スライド編集ビューにデータを渡して表示
        return view('admin.slide_edit', compact('slide_data'));
    }
    
    public function update(Request $request, $id)
    {
        // 更新するスライドのデータを取得
        $obj = Slide::where('id', $id)->first();
    
        // 画像ファイルがアップロードされた場合の処理
        if ($request->hasFile('photo')) {
            // 入力値の検証
            $request->validate([
                'photo' => ['image', 'mimes:jpg,jpeg,png,gif']
            ]);
    
            // 既存の画像ファイルを削除し、新しい画像ファイルをアップロードディレクトリに保存
            unlink(public_path('uploads/' . $obj->photo));
            $ext = $request->file('photo')->extension();
            $file_name = time() . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $file_name);
            $obj->photo = $file_name;
        }
    
        // 入力値を更新してデータベースを更新
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        $obj->update();
    
        // 元のページにリダイレクトして成功メッセージを表示
        return redirect()->back()->with('success', '正常に更新されました。');
    }
    
    public function delete($id)
    {
        // 削除するスライドのデータを取得
        $slide_data = Slide::where('id', $id)->first();
    
        // 画像ファイルを削除し、データベースからスライドを削除
        unlink(public_path('uploads/' . $slide_data->photo));
        $slide_data->delete();
    
        // 元のページにリダイレクトして成功メッセージを表示
        return redirect()->back()->with('success', '正常に削除されました。');
    }
    
}
