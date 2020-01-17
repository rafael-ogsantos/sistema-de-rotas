<?php

namespace App\Classes;

class Uri
{
    public static function uri()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function request()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    } 
}
