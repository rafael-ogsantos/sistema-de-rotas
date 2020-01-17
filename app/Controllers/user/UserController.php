<?php

namespace App\Controllers\User;

class UserController
{
    public function create()
    {
        echo "create";
    }

    public function edit($request)
    {
        dd($request->edit);
    }

    public function show($request)
    {
       dd($request->user);
    }
}
