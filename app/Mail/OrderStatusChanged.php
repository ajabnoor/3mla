<?php

namespace App\Mail;

// use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$user,$url)
    {
        $this->order = $order;
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.statuschanged')
                    ->subject('تحديث حالة الطلب لعملة ال'.$this->order->product->currency->name)
                    ->with([
                        'order'=>$this->order,
                        'user'=>$this->user,
                        'url'=>$this->url,
                    ]);
    }
}
