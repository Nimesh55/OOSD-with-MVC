<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor_View extends Conductor_Model
{
  private $conductor;
  private $conductor_controller;

  public function __construct($conductor_no)
  {

    $this->conductor = Conductor::getInstance($conductor_no);
    $this->conductor_controller = new Conductor_Controller();
  }

  public function getDetails()
  {
    $details = array(

      "first_name" => $this->conductor->getFirstName(),
      "last_name" => $this->conductor->getLastName(),
      "address" => $this->conductor->getAddress(),
      "telephone" => $this->conductor->getTelephone(),
      "vehicle_no" => $this->conductor->getVehicleNo(),
      "district_no" => $this->conductor->getDistrictNo(),
      "email" => $this->conductor->getEmail(),
      "state" => $this->conductor->getState(),
      "district_name" => $this->conductor->getDistricName()
    );
    //print_r($details);
    return $details;
  }


  public function verifyPassenger($passenger_id)
  {

    //$passengerObj = $this->passenger_tracker->getPassenger($passenger_id);
    $pass_details_array = $this->conductor_controller->getPass_by_passenger_id($passenger_id);

    $this->conductor_controller->checkPassExist($pass_details_array);
    $startDate = $pass_details_array["passObj"]->getStartDate();
    $endDate = $pass_details_array["passObj"]->getEndDate();

    $details = array(
      "passenger_name" => $pass_details_array["passenger_name"],
      "company_name" => $pass_details_array["company_name"],
      "route" => $pass_details_array["passObj"]->getBusRoute(),
      "time_period" => $startDate . " to " . $endDate,
      "state" => $this->conductor_controller->checkActiveDate($startDate, $endDate)
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
  public function getGrantedLeave($conductor_no){
      return $this->conductor_controller->getGrantedLeaveDetails($conductor_no);
  }

  public function getConductorState(){
      return $this->conductor->getState();
  }

  public function getConductorNo($conductor_id){
      return Conductor_Tracker::getInstance()->getConductor($conductor_id)->getConductorNo();
  }


}
