<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = array('name','code', 'logo','wallet');


    public function getLogoAttribute($value){
        return url('storage/uploads/').'/'.$value;
    }

    public function products(){
        return $this->hasMany('App\Product');
    }


}
