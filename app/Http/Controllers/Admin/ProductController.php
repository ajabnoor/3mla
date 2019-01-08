<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Currency;
use App\PriceCurrency;
use App\User;
use App\Country;
use App\City;
use App\MyClasses\CryptoPrices;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.list', compact('products'));
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
        $users = User::get()->pluck('name','id');
        $countries = Country::get()->pluck('name','id');
        return view('admin.products.create',  compact ('currencies','pricecurrencies','users','countries'));
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
            'user_id' => 'exists:users,id',
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
        Product::Create($request->all());
        return redirect('/admin/product')->with('success','تم إضافة منتج'); 
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
        $product = Product::find($id);
        $countries = Country::get()->pluck('name','id');
        $pricecurrencies = PriceCurrency::get()->pluck('name','id');
        $users = User::get()->pluck('name','id');
        $currencies = Currency::get()->pluck('name','id');

        return view('admin.products.edit', compact ('countries','users','currencies','pricecurrencies'))->with('product', $product);
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
            'user_id' => 'exists:users,id',
            'currency_id' => 'exists:currencies,id',
            'price_type' => 'required',
            'price_currency_id' => 'required',
            'country_id' => 'exists:countries,id',
            'city_id' => 'exists:cities,id',
            'transfer_methods' => 'required',
            'speed' => 'required',
            'available' => 'required|integer',
            'min_amount' => 'required',
            'status' => 'required'            
        ]);
        $product = Product::find($id);
        $product->update($request->all());
        return redirect('/admin/product')->with('success','تم تحديث المنتج'); 
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
        $product->delete();
        return redirect('/admin/product')->with('success','تم حذف المنتج');
    }

    public function publish($id){
        $product = Product::find($id);
        $product->status = 'published';
        $product->save();
        return back();
    }
    public function getCities($country)
    {
        $cities = City::where('country_id', '=', $country)->get();
        return $cities;
    }

    public function getCurrency($id)
    {
        $currency = Currency::find($id);
        return $currency;
    }

    public function getPriceCurrency($id)
    {
        $pricecurrency = PriceCurrency::find($id);
        return $pricecurrency;
    }
    
    public function getCryptoPrice($id){
        $cryptoprices = new CryptoPrices;
        $usprice = round($cryptoprices->getCryptoCurrencyInformation($id)['price_usd'],2);
        return $usprice;
    }
}
