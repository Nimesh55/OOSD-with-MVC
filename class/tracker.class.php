<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
abstract class Tracker{
    public abstract function getInstance();
}