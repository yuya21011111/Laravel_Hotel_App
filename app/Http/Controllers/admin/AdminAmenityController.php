<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Amenity;

class AdminAmenityController extends Controller
{
    public function index()
    {
        // Amenityモデルから全てのアメニティを取得します
        $amenities = Amenity::get();
    
        // Amenity_viewビューにアメニティデータを渡して表示します
        return view('admin.Amenity_view', compact('amenities'));
    }
    
    public function add()
    {
        // amenity_addビューを表示します
        return view('admin.amenity_add');
    }
    
    public function store(Request $request)
    {
        // リクエストを検証し、nameフィールドが必須で最大50文字までであることを確認します
        $request->validate([
            'name' => ['required','max:50'],
        ]);
    
        // 新しいAmenityオブジェクトを作成し、リクエストのnameフィールドの値を設定して保存します
        $obj = new Amenity();
        $obj->name =  $request->name;
        $obj->save();
    
        // 保存が完了したらリダイレクトし、成功メッセージを表示します
        return redirect()->back()->with('success', 'アメニティは正常に保存されました。');
    }
    
    public function edit($id)
    {
        // 指定されたIDに基づいてAmenityオブジェクトを取得します
        $amenity_data = Amenity::find($id);
    
        // amenity_editビューにアメニティデータを渡して表示します
        return view('admin.amenity_edit', compact('amenity_data'));
    }
    

    public function update(Request $request, $id)
{
    // 指定されたIDに基づいてAmenityオブジェクトを取得します
    $obj = Amenity::where('id', $id)->first();

    // リクエストのnameフィールドの値をAmenityオブジェクトのnameに設定します
    $obj->name = $request->name;

    // Amenityオブジェクトのデータを更新します
    $obj->update();

    // 更新が完了したらリダイレクトし、成功メッセージを表示します
    return redirect()->back()->with('success', 'アメニティは正常に更新されました。');
}

public function delete($id)
{
    // 指定されたIDに基づいてAmenityオブジェクトを取得します
    $amenity_data = Amenity::where('id', $id)->first();

    // Amenityオブジェクトを削除します
    $amenity_data->delete();

    // 削除が完了したらリダイレクトし、成功メッセージを表示します
    return redirect()->back()->with('success', 'アメニティは正常に削除しました。');
}

}
