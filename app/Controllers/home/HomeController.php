<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public static function index()
    {
        $index = "oi";
       return self::view('index', [
           'index' => $index
       ]);
    }
}