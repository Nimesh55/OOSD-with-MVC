<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Board_Manager_View extends Board_Manager_Model{
    private $board_manager;
    private $pass_tracker;
    private $essential_service_tracker;
    private $booking_tracker;
    private $passenger_tracker;

    public function __construct(){
        $this->board_manager = new Board_Manager();
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->essential_service_tracker = EssentialServiceTracker::getInstance();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->passenger_tracker = Passenger_Tracker::getInstance();
    }
    public function getHomeDetails()
    {
        $details=array(
            "name" => $this->board_manager->getName(),
            "pending_passes_cnt"=> $this->getPendingPassesCnt(),
            "approved_passes_cnt"=> $this->getApprovedPassesCount(),
            "total_conductor_cnt"=> $this->getConductorCount());
        return $details;
    }

    public function getPendingPassesDetails()
    {
        $details=array(
            "name" => $this->board_manager->getName(),
            "pendingPassesArray"=> $this->pass_tracker->getPendingPassesSearchArray());
        return $details;
    }

    public function viewPassDetails($pass_no){
        $pass = $this->pass_tracker->getPass($pass_no);
        $service = $this->essential_service_tracker->createService($pass->getServiceNo());

        //Modify this after create passenger tracker
        $details=array(
            "name" => $this->board_manager->getName(),
            "state" => $pass->getState(),
            "passenger_email"=> $this->getPassengerEmail($pass->getPassengerNo()),
            "passenger_name"=> $this->getPassengerName($pass->getPassengerNo()),
            "service_name" => $service->getName(),
            "time_slot" => $pass->getStartDate()." to ".$pass->getEndDate(),
            "reason" => $pass->getReason());
        return $details;
    }

    public function getApprovedPassesDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "approvedPassesArray"=> $this->pass_tracker->getApprovedPassesSearchArray());
        return $details;
    }


    public function getCreateConductorDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "districtArray"=> $this->getDistrictArray(),
            "districtArrayCount"=> count($this->getDistrictArray()));
        return $details;
    }

    public function getAllocateVehicleDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "bookingsArray"=> $this->booking_tracker->getBookingsArray());
        return $details;
    }

    public function getBookingsDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "bookingsArray"=> $this->booking_tracker->getBookingsArray());
        return $details;

    }

    public function getBookingViewDetails($booking_no){
        $booking = $this->booking_tracker->getBooking($booking_no);
        $service = $this->essential_service_tracker->createService($booking->getServiceNo());
        $details=array(
            "name" => $this->board_manager->getName(),
            "service_name" => $service->getName(),
            "reason"=> $booking->getReason(),
            "pickup_location" => $this->getDistrictName($booking->getPickupDistrict()),
            "destination_location" => $this->getDistrictName($booking->getDestinationDistrict()),
            "start_date" => $booking->getStartDate(),
            "end_date" => $booking->getEndDate(),
            "passenger_count" => $booking->getPassengerCount());
        return $details;
    }

    // Change this
    public function getSelectVehicleDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "bookingsArray"=> $this->booking_tracker->getBookingsArray());
        return $details;
    }

    public function getConductorDetails(){
        
    }

}

?>