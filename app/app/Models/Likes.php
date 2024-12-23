<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $fillable = ['item_id','user_id'];

    public $timestamps = false;
    public function like_exist($user_id, $item_id) {        
        return Likes::where('user_id', $user_id)->where('item_id', $item_id)->exists();       
        }

        public function items(){
            return $this ->belongsTo('App\Models\Items','id','item_id');
            }
}




