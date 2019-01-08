<?php

namespace App\Http\Controllers\User;

use Auth;
use App\User;
use App\Order;
use App\Product;
use App\Message;
use App\Country;
use App\City;
use App\Currency;
use App\PriceCurrency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClasses\CryptoPrices;

class MySaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales =  Product::where('user_id', Auth::id())->where('status','!=','deleted')->with('currency','country','city', 'orders.buyer','orders.messages')->orderBy('created_at', 'desc')->get();
        $cryptoprices = new CryptoPrices;
        $cryptoprices->productLoop($sales);
        return view('user.mysales.list', compact('sales'));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::get()->pluck('name','id');
        $pricecurrencies = PriceCurrency::get()->pluck('name','id');
        $countries = Country::get()->pluck('name','id');
        return view('user.mysales.create',  compact ('currencies','users','countries','pricecurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['profit'] == null){
            $request['profit'] = 0;
        }
        $this->validate($request, [
            'type' => 'required',
            'currency_id' => 'exists:currencies,id',
            'price_type' => 'required',
            'price_currency_id' => 'required',
            'country_id' => 'exists:countries,id',
            'city_id' => 'exists:cities,id',
            'transfer_methods' => 'required',
            'speed' => 'required',
            'available' => 'required|integer',
            'min_amount' => 'required',
        ]);
        // dd($request['user_id'] = Auth::id());
        $request['user_id'] = Auth::id();
        Product::Create($request->all());
        return redirect('/user/mysales')->with('success','لقد تمت إضافة المنتج وهو في إنتظار النشر. سيصلك بريد الكتروني بتأكيد النشر');
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
        $product = auth()->user()->products()->where('id',$id)->firstOrFail();
        $countries = Country::get()->pluck('name','id');
        $pricecurrencies = PriceCurrency::get()->pluck('name','id');
        $currencies = Currency::get()->pluck('name','id');
        return view('user.mysales.edit', compact ('countries','currencies','pricecurrencies'))->with('product', $product);
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

        if ($request['profit'] == null){
            $request['profit'] = 0;
        }
        $this->validate($request, [
            'type' => 'required',
            'currency_id' => 'exists:currencies,id',
            'price_type' => 'required',
            'price_currency_id' => 'required',
            'country_id' => 'exists:countries,id',
            'city_id' => 'exists:cities,id',
            'transfer_methods' => 'required',
            'speed' => 'required',
            'available' => 'required|integer',
            'min_amount' => 'required',
        ]);


        $product = Product::find($id);
        $product->update($request->all());
        return redirect('/user/mysales')->with('success','تم تحديث المنتج'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status = 'deleted';
        $product->save();
        return redirect('/user/mysales')->with('success','تم حذف المنتج'); 
    }
}
