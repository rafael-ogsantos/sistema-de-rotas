<?php

namespace App\Models;

class User
{
    public function user(Model $model)
    {
        if(isset($_SESSION[$model->session])){
            return $model->find('id', $_SESSION[$model->user_id]);
        }

        return false;
    }
}
