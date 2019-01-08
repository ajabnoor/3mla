<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\City;

class CountriesAndCities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sa = Country::firstOrCreate([
            'name'=>'السعودية'
        ]);
        $eg = Country::firstOrCreate([
            'name'=>'مصر'
        ]);

        // $JED = City::firstOrCreate([
        //     'name'=>'جدة',
        //     'country_id'=> $sa->id
        // ]);
        
        //best way
        $sa->cities()->firstOrCreate([
            'name'=>'الرياض'
        ]);
        $sa->cities()->firstOrCreate([
            'name'=>'جدة'
        ]);
        $eg->cities()->firstOrCreate([
            'name'=>'الإسكندرية'
        ]);
    }
}
