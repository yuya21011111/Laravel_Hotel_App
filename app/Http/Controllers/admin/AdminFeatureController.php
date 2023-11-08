<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
   // この関数はデータベースからすべての特徴を取得し、それらをビュー 'admin.feature_view' に渡します。
public function index(){
    $features = Feature::get();
    return view('admin.feature_view', compact('features'));
}

// この関数はビュー 'admin.feature_add' を返します。
public function add() {
    return view('admin.feature_add');
}

// この関数は新しい特徴をデータベースに保存する責務を持ちます。
public function store(Request $request) {
    // リクエストパラメータの検証
    $request->validate([
        'icon' => ['required'],
        'heading' =>['required']
    ]);

    // 新しいFeatureオブジェクトを作成し、リクエストパラメータに基づいてそのプロパティを設定します。
    $obj = new Feature();
    $obj->icon = $request->icon;
    $obj->heading = $request->heading;
    $obj->text = $request->text;
    $obj->save();

    // 成功メッセージと共に前のページにリダイレクトします。
    return redirect()->back()->with('success', '特集情報は正常に保存されました。');
}

// この関数は指定されたIDの特徴を取得し、ビュー 'admin.feature_edit' に渡します。
public function edit($id) {
    $feature_data = Feature::find($id);
    return view('admin.feature_edit', compact('feature_data'));
}

// この関数はデータベース内の既存の特徴を更新します。
public function update(Request $request, $id) {
    // リクエストパラメータの検証
    $request->validate([
        'icon' => ['required'],
        'heading' =>['required']
    ]);

    // 指定されたIDでFeatureオブジェクトを検索し、リクエストパラメータに基づいてそのプロパティを更新します。
    $obj = Feature::where('id', $id)->first();
    $obj->icon = $request->icon;
    $obj->heading = $request->heading;
    $obj->text = $request->text;
    $obj->update();

    // 成功メッセージと共に前のページにリダイレクトします。
    return redirect()->back()->with('success', '特集情報が正常に更新されました。');
}

// この関数は指定されたIDの特徴をデータベースから削除します。
public function delete($id) {
    $feature_data = Feature::where('id', $id)->first();
    $feature_data->delete();

    // 成功メッセージと共に前のページにリダイレクトします。
    return redirect()->back()->with('success', '特集情報が正常に削除されました。');
}

}
