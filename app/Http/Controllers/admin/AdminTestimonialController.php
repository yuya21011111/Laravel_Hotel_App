<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class AdminTestimonialController extends Controller
{
   // この関数はデータベースからすべてのテストモニアルを取得し、それらをビュー 'admin.testimonial_view' に渡します。
public function index()
{
    $testimonials = Testimonial::get();
    return view('admin.testimonial_view', compact('testimonials'));
}

// この関数はビュー 'admin.testimonial_add' を返します。
public function add()
{
    return view('admin.testimonial_add');
}

// この関数は新しいテストモニアルをデータベースに保存する責務を持ちます。
public function store(Request $request)
{
    // リクエストパラメータの検証
    $request->validate([
        'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
        'name' => ['required'],
        'designation' => ['required'],
        'comment' => ['required'],
    ]);

    // アップロードされたファイルの拡張子と名前を取得して、公開ディレクトリに移動します。
    $ext = $request->file('photo')->extension();
    $file_name = time() . '.' . $ext;
    $request->file('photo')->move(public_path('uploads/'), $file_name);

    // 新しいTestimonialオブジェクトを作成し、リクエストパラメータに基づいてそのプロパティを設定します。
    $obj = new Testimonial();
    $obj->photo =  $file_name;
    $obj->name = $request->name;
    $obj->designation = $request->designation ;
    $obj->comment = $request->comment;
    $obj->save();

    // 成功メッセージと共に前のページにリダイレクトします。
    return redirect()->back()->with('success', '正常に保存されました。');
}

// この関数は指定されたIDのテストモニアルを取得し、ビュー 'admin.testimonial_edit' に渡します。
public function edit($id)
{

    $testimonial_data = Testimonial::find($id);

    return view('admin.testimonial_edit', compact('testimonial_data'));
}

// この関数はデータベース内の既存のテストモニアルを更新します。
public function update(Request $request, $id)
{
    // リクエストパラメータの検証
    $request->validate([
        'name' => ['required'],
        'designation' => ['required'],
        'comment' => ['required'],
    ]);

    // 指定されたIDでTestimonialオブジェクトを検索し、リクエストパラメータに基づいてそのプロパティを更新します。
    $obj = Testimonial::where('id', $id)->first();

    if ($request->hasFile('photo')) {
        // アップロードされたファイルがある場合、古いファイルを削除し、新しいファイルを公開ディレクトリに移動します。
        $request->validate([
            'photo' => ['image', 'mimes:jpg,jpeg,png,gif']
        ]);
        unlink(public_path('uploads/' . $obj->photo));
        $ext = $request->file('photo')->extension();
        $file_name = time() . '.' . $ext;
        $request->file('photo')->move(public_path('uploads/'), $file_name);
        $obj->photo =  $file_name;
    }

    $obj->name = $request->name;
    $obj->designation = $request->designation ;
    $obj->comment = $request->comment;
    $obj->update();
    return redirect()->back()->with('success', '正常に更新されました。');
}

// この関数は指定されたIDのテストモニアルをデータベースから削除します。
public function delete($id)
{
    $testimonial_data = Testimonial::where('id', $id)->first();
    // ファイルを削除します。
    unlink(public_path('uploads/' . $testimonial_data->photo));
    $testimonial_data->delete();

    // 成功メッセージと共に前のページにリダイレクトします。
    return redirect()->back()->with('success', '正常に削除されました。');
}

}
