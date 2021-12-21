<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor_View extends Conductor_Model{
    private $conductor;

    public function __construct($conductor_no){
        $this->conductor = new Conductor($conductor_no);
    }

    public function getDetails()
    {
      $details=array(
                "conductor_no"=> $this->conductor->getconductor_no(),
                "first_name"=> $this->conductor->getfirst_name(),
                "last_name"=> $this->conductor->getlast_name(),
                "address"=> $this->conductor->getaddress(),
                "telephone"=> $this->conductor->gettelephone(),
                "vehicle_no"=> $this->conductor->getvehicle_no(),
                "district_no"=> $this->conductor->getdistrict_no(),
                "email"=> $this->conductor->getemail(),
                "state"=> $this->conductor->getstate(),
                "district_name" => $this->conductor->getdistric_name()  );
      // echo $this->passenger->getfirst_name();
      return $details;

    }
}

?>