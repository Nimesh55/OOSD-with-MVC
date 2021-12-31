<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor_View extends Conductor_Model
{
  private $conductor;
  private $passenger_tracker;
  private $conductor_controller;
  private $pass_tracker;

  public function __construct($conductor_no)
  {

    $this->conductor = new Conductor($conductor_no);
    $this->passenger_tracker = Passenger_Tracker::getInstance();
    $this->conductor_controller = new Conductor_Controller();
    $this->pass_tracker = Pass_Tracker::getInstance();
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
    //print_r($details);
    return $details;
  }

  public function verifyPassenger($passenger_id)
  {
    
    //$passengerObj = $this->passenger_tracker->getPassenger($passenger_id);
    $pass_details_array = $this->pass_tracker->getPass_by_passenger_id($passenger_id);

    $this->conductor_controller->checkPassExist($pass_details_array);    

    $details = array(
      "passenger_name" => $pass_details_array["passenger_name"],
      "company_name" => $pass_details_array["company_name"],
      "route" => $pass_details_array["passObj"]->getBusRoute(),
      "time_period" => ($pass_details_array["passObj"]->getStartDate())." to ".($pass_details_array["passObj"]->getEndDate()),
      "state" => $pass_details_array["passObj"]->getState()
    );
    
    return $details;
  }
}
