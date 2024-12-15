<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public function like_exist($user_id, $item_id) {        
        return Likes::where('user_id', $user_id)->where('item_id', $item_id)->exists();       
        }
}




