<?php

namespace Traits;

use Traits\Connect;

trait CrudTrait{

    use Connect;

    public function create($nome, $email)
    {
        try {
            $values = array($nome, $email);
           
            print_r($values);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}