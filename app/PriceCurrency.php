<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceCurrency extends Model
{
    protected $fillable = array('name','code','rate');

    public function products(){
        return $this->hasMany('App\Product');
    }
}
