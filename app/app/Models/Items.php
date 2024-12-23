<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'name' , 
        'price' , 
        'explanation' , 
        'image' , 
        'situation' , 
        'buyer_id' , 
        'buy_at' , 
        'del_fig' , 
        'password',
        'purchase_fig' , 
        'updated_at'
    ];

    public function user(){
        return $this ->belongsTo('App\User','user_id','id');
        }
    
    public function likes(){
        return $this ->hasMany('App\Models\Likes','item_id','id');
        }

}
