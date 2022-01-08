<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Vehicle{
    private $vehicle_no;
    private $seat_no;
    public function __construct($vehicle_no, $seat_no)
    {
        $this->vehicle_no = $vehicle_no;
        $this->seat_no = $seat_no;
    }

    public function get_Vehicle_no(){
        return $this->vehicle_no;
    }

    public function get_Seat_no(){
        return $this->seat_no;
    }
}