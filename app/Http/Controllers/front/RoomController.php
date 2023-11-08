<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){
        // Roomモデルから12件のルームデータを取得し、ページネーションして表示します
        $room_all = Room::paginate(12);
        
        // 取得したデータをビューに渡して'front.room'ビューを返す
        return view('front.room',compact('room_all'));
    }

    public function single_room($id){
        // 指定されたIDのルームデータと関連する写真データをRoomモデルから取得する
        $single_room_data = Room::with('rRoomPhoto')->where('id', $id)->first();
        
        // 取得したデータをビューに渡して'front.room_detail'ビューを返す
        return view('front.room_detail', compact('single_room_data'));
    }
}
