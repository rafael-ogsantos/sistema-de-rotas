<?php

$inner_folder = ""; 

define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$inner_folder}login");

if(substr($_SERVER['DOCUMENT_ROOT'], -1) == '/'){
    $barra = "";
}else{
    $barra = "/";
}

define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}{$barra}{$inner_folder}login/");

define("ROOT", "http://localhost/login");

function asset($path): string{
    return ROOT . "/assets{$path}";
}


define("DATABASE", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "users",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
