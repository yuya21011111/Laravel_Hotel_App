<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelPhoto;
class Room extends Model
{
    use HasFactory;

    public function rRoomPhoto(){
        return $this->hasMany(HotelPhoto::class);
    }
}
