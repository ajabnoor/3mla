<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Order;
use Route;

class NavComposer
{
    public $movieList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->movieList = [
        //     'Shawshank redemption',
        //     'Forrest Gump',
        //     'The Matrix',
        //     'Pirates of the Carribean',
        //     'Back to the future',
        // ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $buyer_orders = Order::where('buyer_id','=',Auth::id())->get();
        $owner_orders = Order::where('owner_id','=',Auth::id())->get();
        $buyer_notifications = $buyer_orders->sum('buyer_notifications');
        $owner_notifications = $owner_orders->sum('owner_notifications');
        $view->with('buyer_notifications', $buyer_notifications)
             ->with('owner_notifications', $owner_notifications);
    }

    
}