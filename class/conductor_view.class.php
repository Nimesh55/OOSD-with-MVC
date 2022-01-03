<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor_View extends Conductor_Model
{
  private $conductor;
  private $conductor_controller;
  private $pass_tracker;

  public function __construct($conductor_no)
  {

    $this->conductor = new Conductor($conductor_no);
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
      "time_period" => ($pass_details_array["passObj"]->getStartDate()) . " to " . ($pass_details_array["passObj"]->getEndDate()),
      "state" => $pass_details_array["passObj"]->getState()
    );

    return $details;
  }

  public function showBookings($conductor_no)
  {
    return $this->conductor_controller->getBookings_ForConductor_FromGivenDate($conductor_no);
  }

  public function showBookingInfo($bookingNo)
  {
    $bookingObj = $this->conductor_controller->getBooking($bookingNo);
    
    $details = array(

      "booking_no" => $bookingObj->getBookingNo(),
      "service_name" => $this->conductor_controller->getEssentialServiceName($bookingObj->getServiceNo()),
      "start_date" => $bookingObj->getStartDate(),
      "start_time" => $bookingObj->getStartTime(),
      "end_date" => $bookingObj->getEndDate(),
      "end_time" => $bookingObj->getEndTime(),
      "pickup_district" => $this->conductor_controller->getDistrictName($bookingObj->getPickupDistrict()),
      "pickup_location" => "https://maps.google.com/maps?q=".$bookingObj->getPickupLocation(),
      "destination_district" => $this->conductor_controller->getDistrictName($bookingObj->getDestinationDistrict()),
      "destination_location" => "https://maps.google.com/maps?q=".$bookingObj->getDestinationLocation(),
      "passenger_count" => $bookingObj->getPassengerCount(),
      "flag" => $bookingObj->getFlag()
      
    );
    
    return $details; 
  }
}
