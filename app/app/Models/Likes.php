<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public function like_exist($user_id, $post_id) {        
        return Like::where('user_id', $user_id)->where('post_id', $post_id)->exists();       
        }
}




