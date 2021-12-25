<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

// Tracker Class Singleton
class Conductor_Tracker extends Tracker{
    private static  $instance = null;

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Conductor_Tracker();
        }
        return self::$instance;  
    }

    public function createConductor($conductor_id){
        $conductorObj = new Conductor($conductor_id);
        return $conductorObj;
    }
}

?>