<?php

namespace App\MyClasses;

use Illuminate\Http\Request;
use Route;

class ActiveRoute
{
    public static function isActiveRoute($route)
    {
        if (Route::getFacadeRoot()->current()->uri() == $route) return 'active';
    }


    public static function areActiveRoutes(Array $routes)
    {
        foreach ($routes as $route) {
            if (Route::getFacadeRoot()->current()->uri() == $route) return 'active';
        }

    }
}