<?php

namespace App\Controllers;

use Exception;

class Controller
{
    protected final function view(string $_name, array $vars = [])
    { 
       $_filename = __DIR__ . "/../../views/{$_name}.php";
       if(!file_exists($_filename)){
           die("view {$_name} not found!");
       }
       
       include_once $_filename;
    }

    public function load(string $controller)
    {
        if (substr_count($controller, '@') <= 0) {
            throw new \Exception("Esse controller estar com o formato errado");
        }

        list($controller, $method) =  explode('@', $controller);

        $controller = "App\Controllers\\$controller";

        if (!$this->controllerExits($controller)) {
            throw new \Exception("Esse controller não existe: {$controller}");
        }

        if (!$this->methodExists(new $controller, $method)) {
            throw new \Exception("Esse metodo não existe: {$method}");
        }

        return (object) [
            'controller' => $controller,
            'method' => $method
        ];
    }

    private function controllerExits($controller)
    {
        return class_exists($controller);
    }

    private function  methodExists($controller, $method)
    {
        return method_exists(new $controller, $method);
    }
}
