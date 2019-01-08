<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //add one to many relationship

     public function orders(){
        return $this->hasMany('App\Order', 'buyer_id');
     }
     public function finishedOrders()
    {
        return $this->hasMany('App\Order', 'owner_id')->where('status_id',5);
    }
     public function sales(){
        return $this->hasMany('App\Order','owner_id');
    }
     public function products(){
        return $this->hasMany('App\Product');
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }
    public function badges(){
        return $this->belongsToMany('App\Badge');
    }
    
    
}
