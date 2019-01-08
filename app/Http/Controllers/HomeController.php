<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Currency;
use App\User;
use App\Country;
use App\City;
use App\Order;
use App\MyClasses\CryptoPrices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('home');
    }

    public function getProducts(Request $request)
    { 
        $query = Product::where('status','=','published')->with('currency','user','country','city', 'user.finishedOrders','user.badges','price_currency')->orderBy('created_at', 'desc');
        if (!empty($request->type)){
            $query->where('type', $request->type);
        }
        if (!empty($request->country)){
            $query->where('country_id', $request->country);
        }
        if (!empty($request->currency)){
            $query->where('currency_id', $request->currency);
        }
        $products = $query->paginate(12);

        foreach ($products as $product)
        {
            if ($product->price_type == 'marketwise'){
                $cryptoprices = new CryptoPrices;
                $usprice = round($cryptoprices->getCryptoCurrencyInformation($product->currency->english)['price_usd'],2);
                $product->price = round($usprice*$product->price_currency->rate*((100+$product->profit)/100),2);
            }
        }

        return $products;
    }

    public function getFilters()
    {
        return
        [
            'countries'=>Country::orderBy('name', 'asc')->get(),
            'currencies'=>Currency::orderBy('name', 'asc')->get(),
        ];
    }
}
