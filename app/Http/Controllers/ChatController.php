<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Currency;
use App\User;
use App\Country;
use App\City;
use App\Order;
use App\Message;
use App\Events\MessagePosted;
use App\Mail\NewOrder;
use App\Mail\Notify;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function getMessages($product_id,$newOrder){

        $product = Product::find($product_id);
        $owner_id = $product->user_id;
        $buyer_id = Auth::id();
        $has_order = Order::where('buyer_id','=',$buyer_id )->where('product_id','=',$product_id)->with('messages')->first();
        
        $ownerMessage = ['messages'=>[[
            'id'=>'2',
            'user_type' => 'admin',
            'message' => 'أنت صاحب هذا المنتج ولذلك لا يمكنك استخدام خاصية التواصل مع البائع لهذا المنتج. تستطيع متابعة عملائك ومحادثاتهم بالذهاب إلى قائمة منتجاتي',
            'date' => date('Y-m-d'),
            'user'=>[
                'id'=>'2',
                'name'=>'إدارة موقع عملة'
            ],
        ]],
        'order_id'=>'1',
        'owner'=>true,
        ];

        $newOrderMessage = [[
            'id'=>'2',
            'user_type' => 'admin',
            'message' => 'بمجرد كتابة رسالة للبائع أو إدخال الكمية المطلوبة سيتم حفظ هذا الطلب تحت قائمة طلباتي',
            'date' => date('Y-m-d'),
            'user'=>[
                'id'=>'2',
                'name'=>'إدارة موقع عملة'
            ]]
        ];
        
        if ($owner_id == $buyer_id && $newOrder == "true"){
            
            return $ownerMessage;
        }

        elseif ($owner_id != $buyer_id && $has_order == null ){
            $order = new Order;
            $order->product_id = $product_id;
            $order->owner_id = $owner_id;
            $order->buyer_id = $buyer_id;
            $order->status_id = 0;
            $order->save();
            $order_id = $order->id;

        return [
            'messages'=>$newOrderMessage,
            'order_id'=>$order_id,
            'owner'=>false
        ];

        } elseif ($owner_id != $buyer_id && count($has_order->messages) == 0){

        return [
            
            'messages'=>$newOrderMessage,
            'order_id'=>$has_order->id,
            'owner'=>false
        ];

        }
        
        else
        {
            $order_id = $has_order->id;
        }

        $messages = Message::with('user')
        ->where('order_id',$order_id)->get();

            return [
                 'messages'=> $messages,
                'order_id'=>$order_id,
                'owner'=>false
            ];
    }
    
    public function getOrderMessages($order_id){
        $messages = Message::with('user')->where('order_id',$order_id)->get();
        $order = Order::find($order_id);

        if (Auth::id() == $order->owner_id){
            $order->owner_notifications = 0;
            $owner = true;
        }elseif(Auth::id() == $order->buyer_id){
            $order->buyer_notifications = 0;
            $owner = false;

        }elseif(Auth::user()->hasRole('admin')){
            $owner = false;
        }
            $order->save();

            
            return [
                 'messages'=> $messages,
                'order_id'=>$order_id,
                'owner'=>$owner
            ];
    }

    public function postMessage(){

        $user = Auth::user();
        $user_id = $user->id;
        $product_id = request()->get('product_id');
        $product = Product::where('id',$product_id)->with('user','currency')->firstOrFail();
        $product_user_id = $product->user_id;
        $order_id = request()->get('orderid');

        // if ($user->hasRole('admin')){
        //     $user_type = 'admin';
        //     $user_notify = 'owner';
        // }
         if ($user_id == $product_user_id){

            $user_type = 'owner';
            $user_notify = 'buyer';
        } else {
            $user_type = 'buyer';
            $user_notify = 'owner';
        }
        $message = $user->messages()->create([
        'message' => request()->get('message'),
        'product_id' => $product_id,
        'date' => request()->get('date'),
        'user_type' => $user_type,
        'order_id' => $order_id,
        ]);
        event(new MessagePosted($message, $user));

        $order = Order::where('id',$order_id)->with('buyer','owner')->firstOrFail();

        //first check if this order already has a non seen notifications
        if($order[$user_notify.'_notifications'] == 0){
        //Before sending mail check if this is new order or not
        $messagesCount = Message::where('order_id',$order_id)->count();
        if ($messagesCount == 1){
            $url = route('user.mycustomers.edit', $order_id);
            Mail::to($product->user->email)->send(new NewOrder($product, $user,$url));      
        } else if ($user_type == 'owner'){
            $url = route('user.myorders.edit', $order_id);
            $user = $order->buyer;
            Mail::to($order->buyer->email)->send(new Notify($product,$user,$url));      
        } else if ($user_type == 'buyer'){
            $url = route('user.mycustomers.edit', $order_id);
            $user = $order->owner;
            Mail::to($order->owner->email)->send(new Notify($product,$user,$url));      
        }
        }
        $order->increment($user_notify.'_notifications');
    }
}
