<?php

namespace Traits;

use PDO;
use PDOException;

trait Connect
{
    public static function connDatabase()
    {
        try {
            $conn = new PDO("mysql:host=" . DATABASE['host'] . ";dbname=" . DATABASE['dbname'] . "", "" . DATABASE['username'] . "", DATABASE['passwd']);
            return $conn;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
