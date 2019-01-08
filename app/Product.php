<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = array(
        'user_id', 
        'type',
        'currency_id',
        'price_type',
        'price_currency_id',
        'price',
        'profit',
        'country_id', 
        'city_id',
        'transfer_methods',
        'speed',
        'available',
        'min_amount',
        'status'
    );

    

    public function country(){
        return $this->belongsTo(Country::class);
     }
     public function city(){
        return $this->belongsTo(City::class);
     }
     public function currency(){
        return $this->belongsTo(Currency::class);
     }
     public function price_currency(){
        return $this->belongsTo(PriceCurrency::class);
     }
     public function user(){
        return $this->belongsTo(User::class);
     }
     public function messages(){
        return $this->hasMany('App\Message');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }

}
