<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country(){
       return $this->belongsTo('App\Country');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
}
