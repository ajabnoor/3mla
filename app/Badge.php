<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = array('name','description','class');

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
