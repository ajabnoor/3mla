<?php

use Illuminate\Database\Seeder;
use App\Product;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sell1 = Product::firstOrCreate([
            'user_id'=>'1',
            'type'=>'sell',
            'currency_id'=>'2',
            'price'=>'1500',
            'price_type'=>'fixed',
            'profit'=>'0',
            'price_currency_id'=>'1',
            'country_id'=>'1',
            'city_id'=>'1',
            'transfer_methods'=>'الراجحي - باي بال',
            'speed'=>'5 ساعات',
            'available'=>'3',
            'min_amount'=>'500 ريال',
            'status'=>'published'
        ]);
        $buy1 = Product::firstOrCreate([
            'user_id'=>'2',
            'type'=>'buy',
            'currency_id'=>'1',
            'price'=>'3500',
            'price_type'=>'fixed',
            'profit'=>'0',
            'price_currency_id'=>'1',
            'country_id'=>'2',
            'city_id'=>'3',
            'transfer_methods'=>'ويسرتن يونيون - باي بال',
            'speed'=>'24 ساعة',
            'available'=>'10',
            'min_amount'=>'1000 ريال',
            'status'=>'published'
        ]);
        $sell2 = Product::firstOrCreate([
            'user_id'=>'1',
            'type'=>'sell',
            'currency_id'=>'2',
            'price'=>'9999',
            'price_type'=>'fixed',
            'profit'=>'0',
            'price_currency_id'=>'3',
            'country_id'=>'2',
            'city_id'=>'3',
            'transfer_methods'=>'ويسرتن يونيون - باي بال',
            'speed'=>'24 ساعة',
            'available'=>'10',
            'min_amount'=>'1000 ريال',
            'status'=>'published'
        ]);
        $buy2 = Product::firstOrCreate([
            'user_id'=>'2',
            'type'=>'buy',
            'currency_id'=>'1',
            'price'=>0,
            'price_type'=>'marketwise',
            'profit'=>'5',
            'price_currency_id'=>'2',
            'country_id'=>'1',
            'city_id'=>'1',
            'transfer_methods'=>'ويسرتن يونيون - باي بال',
            'speed'=>'24 ساعة',
            'available'=>'10',
            'min_amount'=>'1000 ريال',
            'status'=>'published'
        ]);
    }
}
