<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

// Tracker Class Singleton
class Conductor_Tracker extends Tracker{
    private static  $instance = null;
    private $conductor_controller;
    private $booking_tracker;

    public function __construct()
    {
        $this->conductor_controller = new Conductor_Controller();
        $this->booking_tracker = Booking_Tracker::getInstance();
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

    public function getAvailableConductors($district_no){
        $conductor_arr = $this->conductor_controller->getConductorsArrayByDistrict($district_no);
        $final_conductors = array();
        foreach ($conductor_arr as $conductor){

        }
    }

    public function checkBooking($conductor_no, $date, $type)
    {
        return $this->booking_tracker->checkBooking($conductor_no, $date, $type);
    }


}

?>