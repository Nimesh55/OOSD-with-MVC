<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class Board_Manager_View extends Board_Manager_Model
{
    private $board_manager;
    private $pass_tracker;
    private $essential_service_tracker;
    private $booking_tracker;
    private $passenger_tracker;
    private $conductor_tracker;
    private $board_manager_controller;

    public function __construct()
    {
        $this->board_manager = new Board_Manager();
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->essential_service_tracker = EssentialServiceTracker::getInstance();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->passenger_tracker = Passenger_Tracker::getInstance();
        $this->conductor_tracker = Conductor_Tracker::getInstance();
        $this->board_manager_controller = new Board_Manager_Controller();
    }
    public function getHomeDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "pending_passes_cnt" => $this->getPendingPassesCnt(),
            "approved_passes_cnt" => $this->getApprovedPassesCount(),
            "total_conductor_cnt" => $this->getConductorCount()
        );
        return $details;
    }

    public function getPendingPassesDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "pendingPassesArray" => $this->pass_tracker->getPendingPassesSearchArray()
        );
        return $details;
    }

    public function viewPassDetails($pass_no)
    {
        $pass = $this->pass_tracker->getPass($pass_no);
        $service = $this->essential_service_tracker->createService($pass->getServiceNo());

        //Modify this after create passenger tracker
        $details = array(
            "name" => $this->board_manager->getName(),
            "state" => $pass->getState(),
            "passenger_email" => $this->getPassengerEmail($pass->getPassengerNo()),
            "passenger_name" => $this->getPassengerName($pass->getPassengerNo()),
            "service_name" => $service->getName(),
            "time_slot" => $pass->getStartDate() . " to " . $pass->getEndDate(),
            "reason" => $pass->getReason()
        );
        return $details;
    }

    public function getApprovedPassesDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "approvedPassesArray" => $this->pass_tracker->getApprovedPassesSearchArray()
        );
        return $details;
    }


    public function getCreateConductorDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "districtArray" => $this->getDistrictArray(),
            "districtArrayCount" => count($this->getDistrictArray())
        );
        return $details;
    }

    public function getAllocateVehicleDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "bookingsArray" => $this->booking_tracker->getBookingsArray()
        );
        return $details;
    }

    public function getBookingsDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "bookingsArray" => $this->booking_tracker->getBookingsArray()
        );
        return $details;
    }

    public function getBookingViewDetails($booking_no)
    {
        $booking = $this->booking_tracker->getBooking($booking_no);
        $service = $this->essential_service_tracker->createService($booking->getServiceNo());

        $vehicle_no = $this->board_manager_controller->getBookedVehicleNo($booking);
        $details = array(
            "name" => $this->board_manager->getName(),
            "service_name" => $service->getName(),
            "reason" => $booking->getReason(),
            "pickup_location" => $this->getDistrictName($booking->getPickupDistrict()),
            "destination_location" => $this->getDistrictName($booking->getDestinationDistrict()),
            "start_date" => $booking->getStartDate(),
            "end_date" => $booking->getEndDate(),
            "booking_state" => $booking->getState(),
            "booked_vehicle" => $vehicle_no,
            "passenger_count" => $booking->getPassengerCount()
        );
        return $details;
    }

    // Change this
    public function getSelectVehicleDetails($booking_no, $district_no)
    {
        $date_range = $this->board_manager_controller->getBookingDateRange($booking_no);
        $details = array(
            "name" => $this->board_manager->getName(),
            "vehicle_list" => $this->conductor_tracker->getAvailableConductors($district_no, $date_range['start_date'], $date_range['end_date'])
        );
        return $details;
    }

    public function getConductorDetails($conductor_id)
    {
        $conductor_obj = $this->conductor_tracker->getConductor($conductor_id);

        $this->board_manager_controller->checkConductorAccountExist($conductor_obj);

        $status = $conductor_obj->getstate();
        $state = "Unavailable";
        if ($status == 0)
            $state = "Available";

        $details = array(
            "fname" => $conductor_obj->getfirst_name(),
            "lname" => $conductor_obj->getlast_name(),
            "district" => $conductor_obj->getdistric_name(),
            "vehicle_no" => $conductor_obj->getvehicle_no(),
            "telephone_no" => $conductor_obj->gettelephone(),
            "status" => $state

        );

        return $details;
    }
}
