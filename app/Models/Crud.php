<?php

namespace App\Models;

class Crud extends Connect
{
    private $crud;

    private function prepare(string $prep, array $exec)
    {
        $this->crud = $this->connDatabase()->prepare($prep);
        $this->crud->execute($exec);
    }

    public function select(string $fields, string $table, string $where, array $exec)
    {
        $this->prepare("SELECT {$fields} FROM {$table} {$where}", $exec);
        return $this->crud;
    }

   
    public function insert($tabela, $values, $exec)
    {
        $this->prepare("INSERT INTO {$tabela} VALUES ({$values})", $exec);
        return $this->crud;
    }
}
