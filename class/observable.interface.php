<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
interface Observable{
    public function addObservers($observer);
    public function removeObservers($observer);
    public function notifyAll();
}