<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";


class Conductor_Controller extends Conductor_Model{
    private $passenger_id;
    private $passengerData;

    public function setPassengerId($passenger_id){
        $this->passenger_id = $passenger_id;
    }

    public function verifyPassgenger()
    {
        
        $passengerObj = Passenger::getInstance($this->passenger_id);
        $this->passengerData = array(
            "passengerName"=> $passengerObj->getFirstName() ." ". $passengerObj->getLastName(),
            "companyName"=> "need to implement",
            "route"=> "need to implement",
            "timePeriod" => "need to implement"
            // include other data as well
        );
        return $this->passengerData;
        
    }

}

?>