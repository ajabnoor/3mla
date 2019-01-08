<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use App\Order;
use App\Product;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClasses\CryptoPrices;

class MyCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =  Order::where('owner_id', Auth::id())->with('product','product.currency','product.country','product.city', 'buyer','messages')->has('messages')->get();
        foreach ($orders as $order)
        {
            if ($order->product->price_type == 'marketwise'){
                $cryptoprices = new CryptoPrices;
                $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
                $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
            }
        }
        return view('user.mycustomers.list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order =  auth()->user()->sales()->where('id',$id)->with('product.currency','product.country','product.city','messages')->firstOrFail();
        if ($order->product->price_type == 'marketwise'){
            $cryptoprices = new CryptoPrices;
            $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
            $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
        }
        return view('user.mycustomers.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
