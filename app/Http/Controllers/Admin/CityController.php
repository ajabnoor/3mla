<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Country;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('country')
                      ->join('countries', 'countries.id', '=', 'cities.country_id')
                      ->orderBy('countries.name', 'asc')->get(['cities.*']);
        return view('admin.cities.list', compact ('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get()->pluck('name','id');
        return view('admin.cities.create', compact ('countries'));
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
            'country' => 'exists:countries,id'            
        ]);

        $city = new City;
        $city->name = $request->input('name');
        $city->country_id = $request->input('country');
        $city->save();

        return redirect('/admin/city')->with('success','تم إضافة المدينة'); 
        
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
        $city = City::find($id);
        $countries = Country::get()->pluck('name','id');

        return view('admin.cities.edit', compact ('countries'))->with('city', $city);
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
            'country' => 'exists:countries,id'
        ]);
        
        $city = City::find($id);
        $city->name = $request->input('name');
        $city->country_id = $request->input('country');
        $city->save();

        return redirect('/admin/city')->with('success','تم تحديث المدينة'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect('/admin/city')->with('success','تم حذف المدينة'); 
    }
}
