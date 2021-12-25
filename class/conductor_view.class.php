<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor_View extends Conductor_Model
{
  private $conductor;
  private $passengerDetails;

  public function __construct($conductor_no)
  {
    $this->conductor = new Conductor($conductor_no);
  }

  public function getDetails()
  {
    $details = array(

      "first_name" => $this->conductor->getfirst_name(),
      "last_name" => $this->conductor->getlast_name(),
      "address" => $this->conductor->getaddress(),
      "telephone" => $this->conductor->gettelephone(),
      "vehicle_no" => $this->conductor->getvehicle_no(),
      "district_no" => $this->conductor->getdistrict_no(),
      "email" => $this->conductor->getemail(),
      "state" => $this->conductor->getstate(),
      "district_name" => $this->conductor->getdistric_name()
    );

    return $details;
  }

  // add other details later(Company Name, Route and Time)
  public function setPassengerDetails($pName)
  {
    $this->passengerDetails = array(
      "passengerName" => $pName,
      "companyName" => "need to implement",
      "route" => "need to implement",
      "timePeriod" => "need to implement"
      // include other data as well
    );
  }
  
  public function getPassengerDetails()
  {
    return $this->passengerDetails;
  }
}
