<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
class Board_Manager_View extends Board_Manager_Model
{
    private $board_manager;
    private $board_manager_controller;

    public function __construct()
    {
        $this->board_manager = new Board_Manager($_SESSION['user_Id']);
        $this->board_manager_controller = new Board_Manager_Controller();
    }
    public function getHomeDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "pending_passes_cnt" => $this->getPendingPassesCnt(),
            "approved_passes_cnt" => $this->getApprovedPassesCount(),
            "total_conductor_cnt" => $this->getConductorCount(),
            "available_conductor_cnt_today" => Conductor_Tracker::getInstance()->getConductorCountToday()
        );
        return $details;
    }

    public function getPendingPassesDetails()
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "pendingPassesArray" => Pass_Tracker::getInstance()->getPendingPassesSearchArray()
        );
        return $details;
    }

    public function viewPassDetails($pass_no)
    {
        $pass = Pass_Tracker::getInstance()->getPass($pass_no);
        $service = EssentialServiceTracker::getInstance()->createService($pass->getServiceNo());
        $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass->getPassengerNo());

        $details = array(
            "name" => $this->board_manager->getName(),
            "state" => $pass->getState(),
            "passenger_email" => $passenger->getEmail(),
            "passenger_name" => $passenger->getFirstName()." ".$passenger->getLastName(),
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
            "approvedPassesArray" => Pass_Tracker::getInstance()->getApprovedPassesSearchArray()
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
            "bookingsArray" => Booking_Tracker::getInstance()->getBookingsArray()
        );
        return $details;
    }

    public function getBookingsDetails($district_no)
    {
        $details = array(
            "name" => $this->board_manager->getName(),
            "bookingsArray" => Booking_Tracker::getInstance()->getBookingsForDistrict($district_no),
            "districts" => $this->board_manager_controller->getDistrictArray()
        );
        return $details;
    }

    public function getBookingViewDetails($booking_no)
    {
        $booking = Booking_Tracker::getInstance()->getBooking($booking_no);
        $service = EssentialServiceTracker::getInstance()->createService($booking->getServiceNo());

        $vehicle_no = $this->board_manager_controller->getBookedVehicleNo($booking);
        $details = array(
            "name" => $this->board_manager->getName(),
            "service_name" => $service->getName(),
            "reason" => $booking->getReason(),
            "pickup_district_no" => $booking->getPickupDistrict(),
            "pickup_district" => $this->getDistrictName($booking->getPickupDistrict()),
            "pickup_location" => "https://maps.google.com/maps?q=".$booking->getPickupLocation(),
            "destination_district" => $this->getDistrictName($booking->getDestinationDistrict()),
            "destination_location" => "https://maps.google.com/maps?q=".$booking->getDestinationLocation(),
            "start_date" => $booking->getStartDate(),
            "end_date" => $booking->getEndDate(),
            "start_time" => $booking->getStartTime(),
            "end_time" => $booking->getEndTime(),
            "booking_state" => $booking->getState(),
            "booked_vehicle" => $vehicle_no,
            "flag" => $booking->getFlag(),
            "passenger_count" => $booking->getPassengerCount()
        );
        return $details;
    }

    public function getSelectVehicleDetails($booking_no, $district_no)
    {
        $date_range = $this->board_manager_controller->getBookingDateRange($booking_no);
        $details = array(
            "name" => $this->board_manager->getName(),
            "vehicle_list" => Conductor_Tracker::getInstance()->getAvailableConductors($district_no, $date_range['start_date'], $date_range['end_date'])
        );
        return $details;
    }

    public function getConductorDetails($conductor_id)
    {
        $conductor_obj = Conductor_Tracker::getInstance()->getConductor($conductor_id);
        $this->board_manager_controller->checkConductorAccountExist($conductor_obj);

        $status = $conductor_obj->getState();
        $state = "Unavailable";
        if ($status == 0)
            $state = "Available";

        $details = array(
            "fname" => $conductor_obj->getFirstName(),
            "lname" => $conductor_obj->getLastName(),
            "district" => $conductor_obj->getDistricName(),
            "vehicle_no" => $conductor_obj->getVehicleNo(),
            "telephone_no" => $conductor_obj->getTelephone(),
            "status" => $state
        );

        return $details;
    }

    public function getPassengerName($passenger_no){
        $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($passenger_no);
        return $passenger->getFirstName()." ".$passenger->getLastName();
    }

    public function showError_CreateConductorAccount($error)
    {
        if ($error == "emptyfield") {
            return "Empty Field. Enter Again!"; 
        }elseif($error == "passwordmismatch"){
            return "Password Mismatched!";
        }elseif($error == "user_exist"){
            return "User Account Exist!";
        }elseif($error == "emailWrong"){
            return "Invalid Email!";
        }elseif($error == "invalidusername"){
            return "Invalid Username!";
        }elseif($error == "invalidtelephone"){
            return "Invalid Telephone Number!";
        }elseif($error == "none"){
            return "none";
        }
    }
}
