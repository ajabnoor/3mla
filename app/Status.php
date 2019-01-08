<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = array('order','name','question' ,'user_type');

    public function order(){
        return $this->hasMany('App\Order');
    }
}
