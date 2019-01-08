<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = array('name');


    // add one to many relationship with cities
    public function cities(){
        return $this->hasMany('App\City');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
}

