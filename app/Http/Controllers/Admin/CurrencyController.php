<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::get();
        return view('admin.currencies.list')->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'logo' => 'image|max:1999',
            'logo' => 'required'
        ]);

        //create file name and save it
        $filenameWithExt =   $request->file('logo')->getClientOriginalname();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('logo')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('logo')->storeAs('/', $filenameToStore);

        $currency = new Currency;
        $currency->name = $request->input('name');
        $currency->english = $request->input('english');
        $currency->code = $request->input('code');
        $currency->wallet = $request->input('wallet');
        $currency->logo = $filenameToStore;

        $currency->save();

        return redirect('/admin/currency')->with('success','تم إضافة العملة'); 
         
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
        $currency = Currency::find($id); 

        return view('admin.currencies.edit')->with('currency', $currency);
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
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'logo_new' => 'image|max:1999'
        ]);
        $currency = Currency::find($id);

        if($request->file('logo_new')){

        
        //create file name and save it
        $filenameWithExt =   $request->file('logo_new')->getClientOriginalname();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('logo_new')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('logo_new')->storeAs('/',$filenameToStore);
        $currency->logo = $filenameToStore;

        }
        
        $currency->name = $request->input('name');
        $currency->english = $request->input('english');
        $currency->code = $request->input('code');
        $currency->wallet = $request->input('wallet');

        $currency->save();

        return redirect(route('admin.currency.index'))->with('success','تم تحديث العملة'); 
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return redirect('/admin/currency')->with('success','تم حذف العملة'); 

    }
}
