<?php

namespace Traits;


trait WildCards
{
    private $explodeUri = [];
    private $parameters = [];

    private function checkRoutesForWildCards()
    {
        $http = $this->request;

        if (!isset($this->$http[uri()])) {

            $matchesWithWildCards = [];

            if ($matches = preg_grep('/\{[a-z]+\}/', array_keys($this->$http))) {
                $matchesWithWildCards = $matches;
            }

            $this->explodeUri = array_values(array_filter(explode('/', uri())));

            $matchesNumberExplode = [];
            foreach ($matchesWithWildCards as $key => $value) {
                $matches = array_values(array_filter(explode('/', $value)));

                if (count($matches) == count($this->explodeUri)) {
                    $matchesNumberExplode[] = $matches;
                }
            }

            if (!empty($matchesNumberExplode)) {
                $this->getNewRoutesWitchWildCards($matchesNumberExplode);
            }
        }
    }

    private function getNewRoutesWitchWildCards($matchesNumberExplode)
    {
        $http = $this->request;
        $newRoute = [];
        $wildCardRoute = [];

        foreach ($matchesNumberExplode as $key => $value) {
            foreach ($this->explodeUri as $explodeKey => $explodeValue) {
                if (preg_match('/\{[a-z]+\}/', $value[$explodeKey])) {
                    $newRoute[$explodeKey] = $explodeValue;
                    $wildCardRoute[$explodeKey] = $value[$explodeKey];
                }

                if ($value[$explodeKey] == $explodeValue) {
                    $newRoute[$explodeKey] = $explodeValue;
                    $wildCardRoute[$explodeKey] = $value[$explodeKey];
                }
            }
            $this->parameters[current($this->explodeUri)] = next($this->explodeUri);
        }
        ksort($newRoute);
        ksort($wildCardRoute);

        $implodeNewUri = '/' . implode('/', $newRoute);
        $implodeWildCardRoute = '/' . implode('/', $wildCardRoute);

        $this->$http[$implodeNewUri] = $this->$http[$implodeWildCardRoute];
    }

    private function parametersWildCards()
    {
        if (isset($this->parameters)) {
            foreach ($this->parameters as $key => $parameter) {
                $this->parameters[$key] = filter_var($parameter,  FILTER_SANITIZE_STRING);

                if (empty($parameter)) {
                    unset($this->parameters[$key]);
                }
            }
        }

        return (object) $this->parameters;
    }

    private function replaceIfNeeded($uri)
    {
        $explodeRouteUri = array_values(array_filter(explode('/', $uri)));
        $explodeUri = array_values(array_filter(explode('/', uri())));
        $newRoute = [];

        if(count($explodeUri) == count($explodeRouteUri)){
            foreach ($explodeRouteUri as $key => $value) {
                if (preg_match('/\{[a-z]+\}/', $value)) {
                   $newRoute[$key] = $explodeUri[$key];
                }

                if ($value == $explodeUri[$key]) {
                    $newRoute[$key] = $explodeUri[$key];
                }
            }

            ksort($newRoute);

            $implodeNewRoute = '/'. implode('/', $newRoute);

            if(uri() == $implodeNewRoute){
                return $implodeNewRoute;
            }
        }
    }
}
