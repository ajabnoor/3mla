<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product,$user,$url)
    {
        $this->product = $product;
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
        return $this->markdown('emails.orders.neworder')
                    ->subject('طلب جديد على عملة ال'.$this->product->currency->name)
                    ->with([
                        'product'=>$this->product,
                        'user'=>$this->user,
                        'url'=>$this->url,
                    ]);;
    }
}
