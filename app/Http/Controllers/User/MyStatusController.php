<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Order;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Mail;



class MyStatusController extends Controller
{
    public function getCurrentStatus($order_id){
        $statuses = Status::get();
        $current_status = Order::find($order_id)->status_id;
        return[
            'statuses'=>$statuses,
            'current_status'=>$current_status,
        ];
    }
    public function updateStatus($order_id,$status_id){
        $order = Order::where('id',$order_id);
        $order->update(['status_id' => $status_id]); 
         

        //send mail
        $mailOrder = $order->with('buyer','owner','product.currency','status')->firstOrFail();
        $status = Status::find($status_id);
        if ($status->user_type == 'buyer'){
            $url = route('user.myorders.edit', $mailOrder->id);
            $user = $mailOrder->owner;
            Mail::to($user->email)->send(new OrderStatusChanged($mailOrder,$user,$url));      
        
        } else if ($status->user_type == 'owner'){
            $url = route('user.mycustomers.edit', $mailOrder->id);
            $user = $mailOrder->buyer;
            Mail::to($user->email)->send(new OrderStatusChanged($mailOrder,$user, $url));

        }
    }
}
