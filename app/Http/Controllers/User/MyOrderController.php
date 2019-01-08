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

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =  Order::where('buyer_id', Auth::id())->with('product.currency','product.country','product.city')->has('messages')->get();
        
        $cryptoprices = new CryptoPrices;
        $cryptoprices->orderLoop($orders);
        
        return view('user.myorders.list', compact('orders'));
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
        $order =  auth()->user()->orders()->where('id',$id)->with('product.currency','product.country','product.city','messages','status', 'product.user.finishedOrders')->firstOrFail();
        $cryptoprices = new CryptoPrices;
        $cryptoprices->singleOrder($order);
        return view('user.myorders.edit', compact('order'));
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
    
    Public function newOrder($product_id){
        $product = Product::find($product_id);
        $cryptoprices = new CryptoPrices;
        $cryptoprices->singleProduct($product);
        
        return view('user.myorders.neworder',compact('product'));
    }

    public function clearNotifications($order_id){
            $order = Order::find($order_id);
        if (Auth::id() == $order->owner_id){
            $order->owner_notifications = 0;
        }elseif(Auth::id() == $order->buyer_id){
            $order->buyer_notifications = 0;
        }
            $order->save();
    }

    public function addAmount(){
        $order = Order::find(request()->get('order_id'));
        $amount = request()->get('amount');
        $order->update(['ordered_amount'=> $amount]);
        if ($order->product->price_type == 'marketwise'){
            $cryptoprices = new CryptoPrices;
            $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
            $total = $amount*round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
        } else {
            $total = $amount*$order->product->price;
        }
        return $total;
    }

    public function getAmount($order_id){
        $order = Order::find($order_id);
        $amount = $order->ordered_amount;
        if ($order->product->price_type == 'marketwise'){
            $cryptoprices = new CryptoPrices;
            $usprice = round($cryptoprices->getCryptoCurrencyInformation($order->product->currency->english)['price_usd']);
            $total = $amount*round($usprice*$order->product->price_currency->rate*((100+$order->product->profit)/100));
        } else {
            $total = $amount*$order->product->price;
        }
        return [
            'amount'=>$amount,
            'total'=>$total
        ];
    }
}
