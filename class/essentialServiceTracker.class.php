<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
// Tracker Class Singelton
class EssentialServiceTracker extends Tracker{
    private EssentialServiceTracker $instance;
    private function __construct(){
    }
    
    public function getInstance(){
        if ($this->instance == null) {
            $this->instance = new EssentialServiceTracker();
        }
        return $this->instance;  
    }
}