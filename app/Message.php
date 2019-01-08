<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','user_id','product_id','date','user_type','order_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
