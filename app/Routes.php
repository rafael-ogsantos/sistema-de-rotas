<?php

namespace App;

use App\Classes\Uri;
use App\Controllers\Controller;
use Traits\VerifyParams;
use Traits\WildCards;

class Routes
{
    use WildCards;
    use VerifyParams;
    
    private $request;
    private $get = [];
    private $post = [];
    private $middleware = [];
    private $name = [];


    public function __construct()
    {
        $this->request = Uri::request();
    }

    public function get(string $uri, string $controller, string $name = null)
    {
        
        if ($this->request == 'get') {
            $this->get[$uri] = $controller;
           
            $this->middleware = $this->replaceIfNeeded($uri);
        }

        return $this;
    }

    public function post(string $uri, string $controller)
    {
        if ($this->request == 'post') {
            $this->post[$uri] = $controller;

            $this->middleware = $this->replaceIfNeeded($uri);
        }

        return $this;
    }

    public function middleware()
    {
        echo "<pre>";
        print_r($this->middleware);   
        echo "</pre>";   
    }

    public function run()
    {
        try {
            $this->checkRoutesForWildCards();
            $http = $this->request;


            if (!isset($this->$http[uri()])) {
                throw new \Exception("Essa url é inválida");
            }

            $controller = (new Controller)->load($this->$http[uri()]);
            $controllerInstance = new $controller->controller;
            $method = $controller->method;
            $controllerInstance->$method($this->parametersWildCards());
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }
}
