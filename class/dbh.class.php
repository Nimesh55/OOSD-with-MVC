<?php

// Extend this class whenever wer need a database Connection
class Dbh{
    private $host = "localhost";
    private $user = "root";
    private $pwd = "root";
    private $dbName = "safe_transit";

    protected function connect(){
        $dsn = 'mysql:host=' . $this->host . ';dbName=' .  $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}