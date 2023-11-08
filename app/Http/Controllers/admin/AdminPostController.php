<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        // データベースからすべての投稿を取得する（Postモデルを使用）
        $posts = Post::get();
        
        // 'admin.post_view'ビューに$posts変数を渡して表示する
        return view('admin.post_view', compact('posts'));
    }
    
    public function add()
    {
        // 'admin.post_add'ビューを表示する
        return view('admin.post_add');
    }
    
    public function store(Request $request)
    {
        // 特定のルールに基づいて、受信したリクエストデータをバリデートする
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'heading' => ['required'],
            'short_content' => ['required'],
            'content' => ['required'],
        ]);
    
        // アップロードされた写真の拡張子を取得する
        $ext = $request->file('photo')->extension();
    
        // 現在のタイムスタンプと拡張子を組み合わせて、一意のファイル名を作成する
        $file_name = time() . '.' . $ext;
    
        // アップロードされた写真を 'uploads/' ディレクトリに移動する
        $request->file('photo')->move(public_path('uploads/'), $file_name);
    
        // Postモデルの新しいインスタンスを作成する
        $obj = new Post();
    
        // 新しい投稿の属性を設定する
        $obj->photo =  $file_name;
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        $obj->total_view = 1;
    
        // データベースに新しい投稿を保存する
        $obj->save();
    
        // 成功メッセージと共に前のページにリダイレクトする
        return redirect()->back()->with('success', '投稿が保存されました。');
    }
    
    public function edit($id)
    {
        // Postモデルを使用して、指定したIDの投稿を検索する
        $post_data = Post::find($id);
    
        // 'admin.post_edit'ビューに$post_data変数を渡して表示する
        return view('admin.post_edit', compact('post_data'));
    }
    
    public function update(Request $request, $id)
    {
        // 特定のルールに基づいて、受信したリクエストデータをバリデートする
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'heading' => ['required'],
            'short_content' => ['required'],
            'content' => ['required'],
        ]);
    
        // Postモデルを使用して、指定したIDの投稿を取得する
        $obj = Post::where('id', $id)->first();
    
        // 新しい写真がアップロードされたかどうかをチェックする
        if ($request->hasFile('photo')) {
            // 新しい写真ファイルをバリデートして処理する
            $request->validate([
                'photo' => ['image', 'mimes:jpg,jpeg,png,gif']
            ]);
    
            // 前の写真ファイルを 'uploads/' ディレクトリから削除する
            unlink(public_path('uploads/' . $obj->photo));
    
            // 新しい写真の拡張子を取得する
            $ext = $request->file('photo')->extension();
    
            // 現在のタイムスタンプと拡張子を組み合わせて、一意のファイル名を作成する
            $file_name = time() . '.' . $ext;
    
            // 新しい写真を 'uploads/' ディレクトリに移動する
            $request->file('photo')->move(public_path('uploads/'), $file_name);
    
            // 投稿の写真属性を更新する
            $obj->photo =  $file_name;
        }
    
        // 投稿の属性を更新する
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
    
        // 更新した投稿を保存する
        $obj->update();
    
        // 成功メッセージと共に前のページにリダイレクトする
        return redirect()->back()->with('success', '投稿が更新されました。');
    }
    
    public function delete($id)
    {
        // Postモデルを使用して、指定したIDの投稿を取得する
        $post_data = Post::where('id', $id)->first();
    
        // 投稿に関連する写真ファイルを 'uploads/' ディレクトリから削除する
        unlink(public_path('uploads/' . $post_data->photo));
    
        // 投稿をデータベースから削除する
        $post_data->delete();
    
        // 成功メッセージと共に前のページにリダイレクトする
        return redirect()->back()->with('success', '投稿が削除されました。');
    }
    
}
