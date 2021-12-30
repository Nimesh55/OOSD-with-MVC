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

    public function validateDetails($passenger_id){
        if (empty($passenger_id)) {
            $_SESSION['error'] = "Empty Field!!!Please enter a Passenger ID";
            return 0;
        }
        //Implement other conditions if there any
        else{
            return $this->verifyPassgenger();
        }
        
    }

    public function getConductor_by_conductor_no($conductor_no)
    {
        $data = $this->getConductor_ByConductorNo($conductor_no);
        $conductor_id  = $data["user_id"];
        // echo $conductor_id;

        $condObject = new Conductor($conductor_id);
        return $condObject;

    } 

}

?>