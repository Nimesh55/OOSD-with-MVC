<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";


class Conductor_Controller extends Conductor_Model{
    private $passenger_id;

    public function setPassengerId($passenger_id){
        $this->passenger_id = $passenger_id;
    }

    public function verifyPassgenger()
    {
        $passengerObj = Passenger::getPassengerInstance($this->passenger_id);
        
    }
}

?>