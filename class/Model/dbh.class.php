<?php

// Extend this class whenever we need a database Connection
class Dbh{
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "safe_transit";

    protected function connect(){
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}