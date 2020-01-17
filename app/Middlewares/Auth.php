<?php

namespace App\Middlewares;

use App\Models\Portal\User;

class Auth{

    public function load()
    {
        $user = new User();
        if(!isset($_SESSION[$user->session])){
            return redirect('/');
        }
    }
}