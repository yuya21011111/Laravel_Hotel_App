<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;

class AdminVideoController extends Controller
{
   // この関数はVideoモデルからすべてのビデオを取得し、それらを'admin.video_view'ビューに渡します。
public function index()
{
    $videos = Video::all();
    return view('admin.video_view', compact('videos'));
}

// この関数は'admin.video_add'ビューを返します。
public function add()
{
    return view('admin.video_add');
}

// この関数はリクエストを検証し、新しいVideoインスタンスを作成し、リクエストからvideo_idとcaptionを保存し、成功メッセージを伴ってリダイレクトします。
public function store(Request $request)
{
    $request->validate([
        'video_id' => ['required'],
    ]);

    $obj = new Video();
    $obj->video_id =  $request->video_id;
    $obj->caption = $request->caption;
    $obj->save();

    return redirect()->back()->with('success', 'ビデオが正常に保存されました。');
}

// この関数は与えられたidパラメータに基づいて特定のビデオデータを取得し、それを'admin.video_edit'ビューに渡します。
public function edit($id)
{

    $video_data = Video::find($id);

    return view('admin.video_edit', compact('video_data'));
}

// この関数は与えられたidパラメータに基づいて特定のビデオレコードを更新し、video_idとcaptionフィールドを更新し、成功メッセージを伴ってリダイレクトします。
public function update(Request $request, $id)
{
    $obj = Video::where('id', $id)->first();

    $obj->video_id = $request->video_id;
    $obj->caption = $request->caption;
    $obj->update();
    
    return redirect()->back()->with('success', 'ビデオが正常に更新されました。');
}

// この関数は与えられたidパラメータに基づいて特定のビデオレコードを削除し、成功メッセージを伴ってリダイレクトします。
public function delete($id){
    $slide_data = Video::where('id', $id)->first();
    $slide_data->delete();

    return redirect()->back()->with('success', 'ビデオが正常に削除されました。');
}

}
