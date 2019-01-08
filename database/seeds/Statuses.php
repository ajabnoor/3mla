<?php

use Illuminate\Database\Seeder;
use App\Status;

class Statuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = Status::firstOrCreate([
            'order'=>'1',
            'name'=>'تم الدفع للبائع',
            'question'=>'هل قمت بتحويل أو دفع المبلغ المطلوب للبائع؟',
            'user_type'=>'buyer',
        ]);
        $second = Status::firstOrCreate([
            'order'=>'2',
            'name'=>'البائع استلم',
            'question'=>'هل استلمت الملبغ كاملا من المشتري مقابل العملة الرقمية التي ستقوم ببيعها؟',
            'user_type'=>'owner',
        ]);
        $third = Status::firstOrCreate([
            'order'=>'3',
            'name'=>'عمولة عملة',
            'question'=>'هل قمت بتحويل عمولة موقع عملة 1% على المحفظة المناسبة للعمولة؟',
            'user_type'=>'owner',
        ]);
        $fourth = Status::firstOrCreate([
            'order'=>'4',
            'name'=>'تم التحويل للمشتري',
            'question'=>'هل قمت بتحويل العملة الرقمية للمشتري؟',
            'user_type'=>'owner',
        ]);
        $fifth = Status::firstOrCreate([
            'order'=>'5',
            'name'=>'المشتري استلم',
            'question'=>'هل استلمت الكمية كاملة من العملة الرقمية؟',
            'user_type'=>'buyer',
        ]);
    }
}
