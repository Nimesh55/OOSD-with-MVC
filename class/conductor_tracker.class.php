<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

// Tracker Class Singleton
class Conductor_Tracker extends Tracker{
    private static  $instance = null;
    private $conductor_controller;

    public function __construct()
    {
        $this->conductor_controller = new Conductor_Controller();
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Conductor_Tracker();
        }
        return self::$instance;  
    }

    // create conductor account by conductor ID
    public function getConductor($conductor_id){
        $conductorObj = new Conductor($conductor_id);
        return $conductorObj;
    }

    //get conductor object by conductor No
    public function getConductorbyNumber($conductor_no){
        return $this->conductor_controller->getConductor_by_conductor_no($conductor_no);

    }
}

?>