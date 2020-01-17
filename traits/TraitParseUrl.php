<?php

namespace Traits;

trait TraitParseUrl
{
    public static function parseUrl($param = null): array
    {
        $url = explode("/", rtrim($_GET['url'], FILTER_SANITIZE_URL));
        
        if($param == null){
            return $url;
        }else{
            return $url[$param];
        }
    }
}
