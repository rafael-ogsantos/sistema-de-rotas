<?php

namespace App\Classes;

use Traits\TraitParseUrl;

class Dispach
{
    private $init;
    private $url;
    private $dir = null;
    private $count;
    private $file;
    private $page;

    use TraitParseUrl;

    public function __construct()
    {
        $this->url = TraitParseUrl::parseUrl();
        $this->count = count($this->url);
        $this->verifyParams();
    }

    public function index()
    {
        echo "index de";
    }

    public function url()
    {
        if(in_array($_GET['url'], ["post", "get"])){
            return "tem";
        }else{
            return "nao tem";
        }
    }


    private function verifyParams()
    {
        if ($this->count == 1 && empty($this->url[0])) {
            $this->page = DIRREQ . 'views/home.php';
        } else {
            $this->verifyDir();
        }
    }

    private function verifyDir()
    {
        $this->init = $this->url[0] . '/';
        for ($i = 0; $i < $this->count; $i++) {
            if (is_dir($this->init)) {
                if ($i == 0) {
                    $this->dir .= $this->init;
                } elseif (is_dir($this->dir . $this->url[$i])) {
                    $this->dir .= $this->url[$i] . '/';
                } else {
                    $this->file = $this->url[$i];
                    break;
                }
            } else {
                if ($i == 0) {
                    $this->dir .= 'views/';
                } 
                if (is_dir($this->dir . $this->url[$i])) {
                    $this->dir .= $this->url[$i] . '/';
                } else {
                    $this->file = $this->url[$i];
                    break;
                }
            }
        }

        $this->dir = str_replace("//", "/", $this->dir);
        $this->verifyFile();
    }

    private function verifyFile()
    {
        $dirAbs = DIRREQ . $this->dir;
        if (file_exists($dirAbs . $this->file . '.php')) {
            $this->page = $dirAbs . $this->file . '.php';
        } elseif (file_exists($dirAbs . 'home.php')) {
            $this->page = $dirAbs . 'home.php';
            
        } else {
            $this->page = DIRREQ . 'views/404.php';
        }
    }
    public function getInclude()
    {
        return $this->page;
    }
}
