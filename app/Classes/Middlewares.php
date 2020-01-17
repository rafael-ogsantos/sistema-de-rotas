<?php

namespace App\Classes;

use App\Middlewares\Auth;

class Middlewares{

    public function load()
    {
        return [
           'auth' => Auth::class
        //    'guest' =>
        ];
    }

}