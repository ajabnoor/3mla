<?php

use Illuminate\Database\Seeder;
use App\PriceCurrency;

class PriceCurrencies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $USD = PriceCurrency::firstOrCreate([
            'name'=>'دولار أمريكي',
            'code'=>'USD',
            'rate'=>1,
        ]);
        $SAR = PriceCurrency::firstOrCreate([
            'name'=>'ريال سعودي',
            'code'=>'SAR',
            'rate'=>3.75,
        ]);
        $EGP = PriceCurrency::firstOrCreate([
            'name'=>'جنيه مصري',
            'code'=>'EGP',
            'rate'=>18,
        ]);
    }
}
