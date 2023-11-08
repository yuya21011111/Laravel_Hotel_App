<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

class AdminFaqController extends Controller
{
   /**
 * 全てのFAQを取得し、'admin.faq_view'ビューに渡す。
 */
public function index()
{
    $faqs = Faq::get();
    return view('admin.faq_view', compact('faqs'));
}

/**
 * 'admin.faq_add'ビューを返す。
 */
public function add()
{
    return view('admin.faq_add');
}

/**
 * リクエストを検証し、新しいFaqインスタンスを作成し、リクエストからの質問と回答を保存し、成功した場合は成功メッセージと共に戻る。
 */
public function store(Request $request)
{
    $request->validate([
        'question' => ['required','max:50'],
        'answer' => ['required'],
    ]);

    $obj = new Faq();
    $obj->question =  $request->question;
    $obj->answer = $request->answer;
    $obj->save();

    return redirect()->back()->with('success', 'FAQが正常に保存されました。');
}

/**
 * 指定されたidパラメータに基づいて特定のfaqデータを取得し、それを'admin.faq_edit'ビューに渡す。
 */
public function edit($id)
{
    $faq_data = Faq::find($id);
    return view('admin.faq_edit', compact('faq_data'));
}

/**
 * 指定されたidパラメータに基づいて特定のfaqレコードを更新し、
 * リクエストからの質問と回答フィールドを更新し、成功メッセージと共に戻る。
 */
public function update(Request $request, $id)
{
    $obj = Faq::where('id', $id)->first();

    $obj->question = $request->question;
    $obj->answer = $request->answer;
    $obj->update();
    
    return redirect()->back()->with('success', 'FAQが正常に更新されました。');
}

/**
 * 指定されたidパラメータに基づいて特定のfaqレコードを削除し、成功メッセージと共に戻る。
 */
public function delete($id){
    $faq_data = Faq::where('id', $id)->first();
    $faq_data->delete();

    return redirect()->back()->with('success', 'FAQが正常に削除されました。');
}

}
