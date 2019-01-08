<?php

use Illuminate\Database\Seeder;
use App\Message;

class Messages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $first = Message::firstOrCreate([
        //     'order_id'=>1,
        //     'user_id'=>1,
        //     'user_type'=>'owner',
        //     'product_id'=>1,
        //     'message'=>'أهلا وسهلا',
        //     'date'=>'Sun Aug 19 2018 00:21:45 GMT+0200 (Central European Summer Time)'
        // ]);
        // $second = Message::firstOrCreate([
        //     'order_id'=>1,
        //     'user_id'=>2,
        //     'user_type'=>'buyer',
        //     'product_id'=>1,
        //     'message'=>'هلا بيك',
        //     'date'=>'Sun Aug 19 2018 00:21:50 GMT+0200 (Central European Summer Time)'
        // ]);
    }
}
