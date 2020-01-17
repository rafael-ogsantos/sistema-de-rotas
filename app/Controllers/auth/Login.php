<?php

namespace App\Controllers\Auth;

use App\Models\Portal\User;

class Login
{
    public function login()
    {
       $user = new User();
       $user->name = $_POST['nome'];
       $user->email = $_POST['email'];
       $user->save();
    }
}
