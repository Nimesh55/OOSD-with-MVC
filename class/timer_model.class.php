<?php

require_once "dbh.class.php";
class Timer_Model extends Dbh
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Timer_Model();
        }
        return self::$instance;
    }


}