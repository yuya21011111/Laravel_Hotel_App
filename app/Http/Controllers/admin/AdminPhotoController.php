<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photo;

class AdminPhotoController extends Controller
{
   /**
 * データベースからすべての写真を取得し、'admin.photo_view' ビューに表示します。
 *
 * @return \Illuminate\View\View
 */
public function index()
{
    $photos = Photo::get();
    return view('admin.photo_view', compact('photos'));
}

/**
 * 新しい写真を追加するために 'admin.photo_add' ビューを表示します。
 *
 * @return \Illuminate\View\View
 */
public function add()
{
    return view('admin.photo_add');
}

/**
 * 検証済みのリクエストデータに基づいて、新しい写真をデータベースに保存します。
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function store(Request $request)
{
    $request->validate([
        'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
    ]);

    // アップロードされた写真ファイルの拡張子を取得します
    $ext = $request->file('photo')->extension();

    // 現在のタイムスタンプと拡張子を使用して一意のファイル名を生成します
    $file_name = time() . '.' . $ext;

    // アップロードされた写真ファイルを 'uploads/' ディレクトリに移動します
    $request->file('photo')->move(public_path('uploads/'), $file_name);

    // Photo モデルの新しいインスタンスを作成します
    $obj = new Photo();

    // 新しい写真の属性を設定します
    $obj->photo =  $file_name;
    $obj->caption = $request->caption;

    // データベースに新しい写真を保存します
    $obj->save();

    // 成功メッセージと共に前のページにリダイレクトします
    return redirect()->back()->with('success', '画像が正常に保存されました。');
}

/**
 * 特定の写真を編集するために 'admin.photo_edit' ビューを表示します。
 *
 * @param  int  $id
 * @return \Illuminate\View\View
 */
public function edit($id)
{
    $photo_data = Photo::find($id);

    return view('admin.photo_edit', compact('photo_data'));
}

/**
 * 検証済みのリクエストデータに基づいて、特定の写真の属性をデータベースで更新します。
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Request $request, $id)
{
    $obj = Photo::where('id', $id)->first();

    if ($request->hasFile('photo')) {
        $request->validate([
            'photo' => ['image', 'mimes:jpg,jpeg,png,gif']
        ]);

        // 前の写真ファイルを 'uploads/' ディレクトリから削除します
        unlink(public_path('uploads/' . $obj->photo));

        // 新しい写真ファイルの拡張子を取得します
        $ext = $request->file('photo')->extension();

        // 現在のタイムスタンプと拡張子を使用して一意のファイル名を生成します
        $file_name = time() . '.' . $ext;

        // 新しい写真ファイルを 'uploads/' ディレクトリに移動します
        $request->file('photo')->move(public_path('uploads/'), $file_name);

        // 写真属性を新しいファイル名で更新します
        $obj->photo =  $file_name;
    }

    // キャプション属性を更新された値で更新します
    $obj->caption = $request->caption;

    // 更新された写真をデータベースに保存します
    $obj->update();

    // 成功メッセージと共に前のページにリダイレクトします
    return redirect()->back()->with('success', '画像が正常に更新されました。');
}

/**
 * 特定の写真をデータベースから削除し、それに対応するファイルを 'uploads/' ディレクトリから削除します。
 *
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function delete($id){
    $photo_data = Photo::where('id', $id)->first();

    // 'uploads/' ディレクトリから写真ファイルを削除します
    unlink(public_path('uploads/' . $photo_data->photo));
    
    // データベースから写真を削除します
    $photo_data->delete();

    // 成功メッセージと共に前のページにリダイレクトします
    return redirect()->back()->with('success', '画像が正常に削除されました。');
}

}
