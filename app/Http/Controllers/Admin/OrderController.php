<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClasses\CryptoPrices;
class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::with('product','status','buyer','owner')->has('messages')->orderBy('created_at', 'desc')->get();
//        $orders = Order::join('messages','orders.id','=','messages.order_id')->select('orders.*')->groupBy('orders.id')->orderBy('messages.created_at', 'desc')->get();
        return view('admin.orders.list', compact ('orders'));
    }

    public function show($id)
    {
        // dd(auth()->user()->hasRole('admin'));
        if (auth()->user()->hasRole('admin')){
            $order =  Order::where('id',$id)->with('product.currency','product.country','product.city','messages','status')->firstOrFail();
            return view('admin.orders.show', compact('order'));
        }
    }

    public function loginAsOwner($user_id,$order_id){

        if (auth()->user()->hasRole('admin')){
            Auth::loginUsingId($user_id);

            $order =  Order::where('id',$order_id)->with('product.currency','product.country','product.city','messages','status')->firstOrFail();
            if ($order->product->price_type == 'marketwise'){
                $cryptoprices = new CryptoPrices;
                $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
                $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
            }
            return view('user.mycustomers.edit', compact('order'));
        }
    }

    public function loginAsBuyer($user_id,$order_id){

        if (auth()->user()->hasRole('admin')){
            Auth::loginUsingId($user_id);

            $order =  Order::where('id',$order_id)->with('product.currency','product.country','product.city','messages','status')->firstOrFail();
            if ($order->product->price_type == 'marketwise'){
                $cryptoprices = new CryptoPrices;
                $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
                $order->product->price = round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
            }
            return view('user.myorders.edit', compact('order'));
        }
    }
}
