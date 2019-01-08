<?php

use Illuminate\Database\Seeder;
use App\Currency;

class Currencies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BTC = Currency::firstOrCreate([
            'name'=>'بيتكوين',
            'english'=>'bitcoin',
            'code'=>'BTC',
            'wallet'=>'3Hhe4id6FRJMxnLoihYBYAWMA2oYPtUci4',
            'logo'=>'BTC_1534291518.png'
        ]);
        $ETH = Currency::firstOrCreate([
            'name'=>'إيثيريوم',
            'english'=>'ethereum',
            'code'=>'ETH',
            'wallet'=>'0x4DB8C4eaCe4bc26192cC7AD1f7D0214c10214782',
            'logo'=>'ETH_1534291599.png'
        ]);
    }
}
