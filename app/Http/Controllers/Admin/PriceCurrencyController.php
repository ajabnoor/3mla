<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PriceCurrency;


class PriceCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricecurrencies = PriceCurrency::get();
        return view('admin.pricecurrencies.list')->with('pricecurrencies', $pricecurrencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pricecurrencies.create');

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
            'rate' => 'required',
        ]);
        PriceCurrency::Create($request->all());
        return redirect('/admin/pricecurrency')->with('success','تم إضافة العملة'); 
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
        $pricecurrency = PriceCurrency::find($id);
        return view('admin.pricecurrencies.edit')->with('pricecurrency', $pricecurrency);
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
            'rate' => 'required',
        ]);
        $pricecurrency = PriceCurrency::find($id);
        $pricecurrency->update($request->all());
        return redirect('/admin/pricecurrency')->with('success','تم تحديث العملة');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pricecurrency = PriceCurrency::find($id);
        $pricecurrency->delete();
        return redirect('/admin/pricecurrency')->with('success','تم حذف العملة'); 
    }
}
