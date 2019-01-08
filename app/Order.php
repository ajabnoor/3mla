<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = array('product_id','owner_id', 'buyer_id','ordered_amount','status_id');

    public function messages(){
        return $this->hasMany('App\Message');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function buyer(){
        return $this->belongsTo('App\User','buyer_id');
    }
    public function owner(){
        return $this->belongsTo('App\User','owner_id');
    }
    public function status(){
        return $this->belongsTo('App\Status');
    }
    

}
