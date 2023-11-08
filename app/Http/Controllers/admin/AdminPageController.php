<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class AdminPageController extends Controller
{
    public function about()
    {
        // "Page"モデルからidが1のページデータを取得します
        $page_data = Page::where('id', 1)->first();
    
        // ビュー「admin.page_about」を返し、その中に「page_data」変数を渡します
        return view('admin.page_about', compact('page_data'));
    }
    
    public function about_update(Request $request)
    {
        // コメントアウトされたコードはバリデーションの例です。このコードでは使用されていません。
    
        // "Page"モデルからidが1のページデータを取得します
        $obj = Page::where('id', 1)->first();
    
        // 受け取ったリクエストの値で"$obj"オブジェクトのプロパティを更新します
        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_status = $request->about_status;
    
        // 更新したオブジェクトをデータベースに保存します
        $obj->update();
    
        // 成功メッセージを含めて前のページにリダイレクトします
        return redirect()->back()->with('success', 'ページが正常に更新されました。');
    }
    

    public function terms()
{
    // "Page"モデルからidが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // ビュー「admin.page_terms」を返し、その中に「page_data」変数を渡します
    return view('admin.page_terms', compact('page_data'));
}

public function terms_update(Request $request)
{

    // コメントアウトされたコードはバリデーションの例です。このコードでは使用されていません。

    // "Page"モデルからidが1のページデータを取得します
    $obj = Page::where('id', 1)->first();

    // 受け取ったリクエストの値で"$obj"オブジェクトのプロパティを更新します
    $obj->terms_heading = $request->terms_heading;
    $obj->terms_content = $request->terms_content;
    $obj->terms_status = $request->terms_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function privacy()
{
    // "Page"モデルからidが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // ビュー「admin.page_privacy」を返し、その中に「page_data」変数を渡します
    return view('admin.page_privacy', compact('page_data'));
}

public function privacy_update(Request $request)
{

    // "Page"モデルからidが1のページデータを取得します
    $obj = Page::where('id', 1)->first();

    // 受け取ったリクエストの値で"$obj"オブジェクトのプロパティを更新します
    $obj->privacy_heading = $request->privacy_heading;
    $obj->privacy_content = $request->privacy_content;
    $obj->privacy_status = $request->privacy_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function contact()
{
    // "Page"モデルからidが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // ビュー「admin.page_contact」を返し、その中に「page_data」変数を渡します
    return view('admin.page_contact', compact('page_data'));
}

public function contact_update(Request $request)
{

    // "Page"モデルからidが1のページデータを取得します
    $obj = Page::where('id', 1)->first();

    // 受け取ったリクエストの値で"$obj"オブジェクトのプロパティを更新します
    $obj->contact_heading = $request->contact_heading;
    $obj->contact_map = $request->contact_map;
    $obj->contact_status = $request->contact_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function photo_gallery()
{
    // "Page"モデルからidが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // ビュー「admin.page_photo_gallery」を返し、その中に「page_data」変数を渡します
    return view('admin.page_photo_gallery', compact('page_data'));
}

public function photo_gallery_update(Request $request)
{

    // "Page"モデルからidが1のページデータを取得します
    $obj = Page::where('id', 1)->first();

    // 受け取ったリクエストの値で"$obj"オブジェクトのプロパティを更新します
    $obj->photo_gallery_heading = $request->photo_gallery_heading;
    $obj->photo_gallery_status = $request->photo_gallery_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}

public function video_gallery()
{
    $page_data = Page::where('id', 1)->first();
    return view('admin.page_video_gallery', compact('page_data'));
}

public function video_gallery_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから取得した値でオブジェクトのプロパティを更新します
    $obj->video_gallery_heading = $request->video_gallery_heading;
    $obj->video_gallery_status = $request->video_gallery_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function faq()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_faq'ビューにページデータを渡して表示します
    return view('admin.page_faq', compact('page_data'));
}

public function faq_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから取得した値でオブジェクトのプロパティを更新します
    $obj->faq_heading = $request->faq_heading;
    $obj->faq_status = $request->faq_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function blog()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_blog'ビューにページデータを渡して表示します
    return view('admin.page_blog', compact('page_data'));
}

public function blog_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから取得した値でオブジェクトのプロパティを更新します
    $obj->blog_heading = $request->blog_heading;
    $obj->blog_status = $request->blog_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function room()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_room'ビューにページデータを渡して表示します
    return view('admin.page_room', compact('page_data'));
}

public function room_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->room_heading = $request->room_heading;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function cart()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_cart'ビューにページデータを渡して表示します
    return view('admin.page_cart', compact('page_data'));
}

public function cart_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->cart_heading = $request->cart_heading;
    $obj->cart_status = $request->cart_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function checkout()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_checkout'ビューにページデータを渡して表示します
    return view('admin.page_checkout', compact('page_data'));
}

public function checkout_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->checkout_heading = $request->checkout_heading;
    $obj->checkout_status = $request->checkout_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}

public function payment()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_payment'ビューにページデータを渡して表示します
    return view('admin.page_payment', compact('page_data'));
}

public function payment_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->payment_heading = $request->payment_heading;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function signup()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();
    
    // 'admin.page_signup'ビューにページデータを渡して表示します
    return view('admin.page_signup', compact('page_data'));
}

public function signup_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->signup_heading = $request->signup_heading;
    $obj->signup_status = $request->signup_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function signin()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // 'admin.page_signin'ビューにページデータを渡して表示します
    return view('admin.page_signin', compact('page_data'));
}

public function signin_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->signin_heading = $request->signin_heading;
    $obj->signin_status = $request->signin_status;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}


public function forget_password()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // 'admin.page_forget_password'ビューにページデータを渡して表示します
    return view('admin.page_forget_password', compact('page_data'));
}

public function forget_password_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->forget_password_heading = $request->forget_password_heading;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}

public function reset_password()
{
    // idが1のページデータを取得します
    $page_data = Page::where('id', 1)->first();

    // 'admin.page_reset_password'ビューにページデータを渡して表示します
    return view('admin.page_reset_password', compact('page_data'));
}

public function reset_password_update(Request $request)
{
    // idが1のPageモデルのインスタンスを取得します
    $obj = Page::where('id', 1)->first();

    // リクエストから受け取った値でオブジェクトのプロパティを更新します
    $obj->reset_password_heading = $request->reset_password_heading;

    // 更新したオブジェクトをデータベースに保存します
    $obj->update();

    // 成功メッセージを含めて前のページにリダイレクトします
    return redirect()->back()->with('success', 'ページが正常に更新されました。');
}

}
