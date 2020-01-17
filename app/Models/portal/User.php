<?php

namespace App\Models\Portal;

use App\Models\Connect;
use Traits\CrudTrait;

class User{
    public $name;
    public $email;

    use CrudTrait;

    public function save()
    {
        $nome = $this->name;
        $email = $this->email;
        $this->create($nome, $email);
    }
    
}
