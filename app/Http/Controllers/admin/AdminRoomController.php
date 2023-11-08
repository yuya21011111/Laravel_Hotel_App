<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\HotelPhoto;
use PhpParser\Node\Expr\FuncCall;

class AdminRoomController extends Controller
{
    public function index()
    {
        // Roomモデルから全ての部屋のデータを取得します
        $rooms = Room::get();
    
        // 'admin.room_view'ビューに部屋のデータを渡して表示します
        return view('admin.room_view', compact('rooms'));
    }
    
    public function add()
    {
        // Amenityモデルから全てのアメニティのデータを取得します
        $all_amenities = Amenity::get();
    
        // 'admin.room_add'ビューにアメニティのデータを渡して表示します
        return view('admin.room_add', compact('all_amenities'));
    }
    

    public function store(Request $request)
    {
        // リクエストデータのバリデーションルールを定義します
        $request->validate([
            'featured_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'name' => ['required'],
            'description' => ['required','max:300'],
            'price' => ['required'],
            'total_rooms' => ['required'],
        ]);
    
        // 選択されたアメニティを連結するための変数を初期化します
        $amenities = '';
        
        // ループ内で使用する変数を初期化します
        $i = 0;
    
        // もし、リクエストにarr_amenitiesが存在する場合は、それを連結します
        if (isset($request->arr_amenities)) {
            foreach ($request->arr_amenities as $item) {
                if ($i == 0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ',' . $item;
                }
                $i++;
            }
        }
    
        // アップロードされたファイルの拡張子を取得します
        $ext = $request->file('featured_photo')->extension();
        // ファイル名を作成します（現在のタイムスタンプと拡張子を組み合わせます）
        $file_name = time() . '.' . $ext;
        // ファイルを指定されたパスに移動します（public_path('uploads/')ディレクトリに移動します）
        $request->file('featured_photo')->move(public_path('uploads/'), $file_name);
        // 新しいRoomモデルのインスタンスを作成します
        $obj = new Room();
        // インスタンスに各プロパティの値をセットします
        $obj->featured_photo =  $file_name;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        // モデルを保存します
        $obj->save();
    
        // 元のページにリダイレクトし、成功メッセージをフラッシュメッセージとして表示します
        return redirect()->back()->with('success', '部屋情報を登録しました。');
    }
    

    public function edit($id)
    {
        // すべてのアメニティを取得します
        $all_amenities = Amenity::get();
    
        // 指定されたIDを持つRoomを取得します
        $room_data = Room::where('id',$id)->first();
        
        // 既存のアメニティリストを初期化します
        $existing_amenities = array();
        
        // もし、Roomのamenitiesプロパティが空でない場合は、それをコンマで分割して配列に格納します
        if ($room_data->amenities != '') {
            $existing_amenities = explode(',', $room_data->amenities);
        }
        
        // 'admin.room_edit'ビューにデータを渡して表示します
        return view('admin.room_edit', compact('room_data','all_amenities','existing_amenities'));
    }
    

    public function update(Request $request, $id)
    {
        // 指定されたIDを持つRoomを取得します
        $obj = Room::where('id', $id)->first();
    
        // もし、リクエストにfeatured_photoがある場合は処理します
        if ($request->hasFile('featured_photo')) {
            // featured_photoが画像であること、拡張子が許可されていることをバリデートします
            $request->validate([
                'featured_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            ]);
    
            // 古いfeatured_photoファイルを削除します
            unlink(public_path('uploads/' . $obj->featured_photo));
    
            // アップロードされたファイルの拡張子とファイル名を取得します
            $ext = $request->file('featured_photo')->extension();
            $file_name = time() . '.' . $ext;
    
            // ファイルを指定されたパスに移動します
            $request->file('featured_photo')->move(public_path('uploads/'), $file_name);
    
            // Roomオブジェクトのfeatured_photoプロパティを更新します
            $obj->featured_photo =  $file_name;
        }
    
        // amenitiesを初期化します
        $amenities = '';
        $i = 0;
    
        // もしarr_amenitiesがセットされている場合は処理します
        if (isset($request->arr_amenities)) {
            foreach ($request->arr_amenities as $item) {
                // 最初の要素以外はカンマを追加します
                if ($i == 0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ',' . $item;
                }
                $i++;
             }
        }
    

        // Roomオブジェクトのプロパティを更新します
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
    
        // Roomオブジェクトをデータベースに更新します
        $obj->update();
    
        // 更新が完了したらリダイレクトし、成功メッセージを表示します
        return redirect()->back()->with('success', '部屋情報を更新しました。');
    }
    

    public function delete($id){
        // 指定されたIDを持つRoomオブジェクトを取得します
        $room_data = Room::where('id', $id)->first();
    
        // 関連するfeatured_photoファイルを削除します
        unlink(public_path('uploads/' . $room_data->featured_photo));
    
        // Roomオブジェクトを削除します
        $room_data->delete();
    
        // 関連するHotelPhotoオブジェクトを取得します
        $hote_photo_data = HotelPhoto::where('room_id',$id)->get();
    
        // 各HotelPhotoオブジェクトと関連する写真ファイルを削除します
        foreach($hote_photo_data as $item) {
            unlink(public_path('uploads/'.$item->photo));
            $item->delete();
        }
    
        // 削除が完了したらリダイレクトし、成功メッセージを表示します
        return redirect()->back()->with('success', '部屋情報を削除しました。.');
    }
    
    public function gallery($id){
       // 指定されたIDを持つRoomオブジェクトを取得します
       $room_data = Room::where('id',$id)->first();
    
       // 指定されたIDを持つHotelPhotoオブジェクトを取得します
       $hotel_photos = HotelPhoto::where('room_id',$id)->get();
    
       // admin.room_galleryビューにデータを渡して表示します
        return view('admin.room_gallery',compact('room_data','hotel_photos'));
    }
    

    public function gallery_store(Request $request, $id){
        // リクエストを検証し、photoフィールドが必須で画像形式(jpg、jpeg、png、gif)であることを確認します
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        // 画像ファイルの拡張子を取得します
        $ext = $request->file('photo')->extension();
    
        // ファイル名を生成します（現在のUNIXタイムスタンプ + 拡張子）
        $file_name = time() . '.' . $ext;
    
        // 画像ファイルを指定されたパスに移動させます
        $request->file('photo')->move(public_path('uploads/'), $file_name);
    
        // 新しいHotelPhotoオブジェクトを作成し、ファイル名と関連するroom_idを設定します
        $obj = new HotelPhoto();
        $obj->photo =  $file_name;
        $obj->room_id = $id;
        $obj->save();
    
        // 保存が完了したらリダイレクトし、成功メッセージを表示します
        return redirect()->back()->with('success', '画像情報は正常に登録されました。');
    }
    
    public function gallery_delete($id){
        // 指定されたIDを持つHotelPhotoオブジェクトを取得します
        $room_data = HotelPhoto::where('id', $id)->first();
    
        // 関連する写真ファイルを削除します
        unlink(public_path('uploads/' . $room_data->photo));
    
        // HotelPhotoオブジェクトを削除します
        $room_data->delete();
    
        // 削除が完了したらリダイレクトし、成功メッセージを表示します
        return redirect()->back()->with('success', '画像は正常に削除されました。');
    }
    
}
