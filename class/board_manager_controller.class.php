<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model
{

    private $pass_tracker;
    private $booking_tracker;
    private $conductor_tracker;
    private $passenger_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->conductor_tracker = Conductor_Tracker::getInstance();
        $this->passenger_tracker = Passenger_Tracker::getInstance();
    }

    public function approvePass($pass_no)
    {
        $_SESSION['success'] = "Pass approved successfully";
        $pass = $this->pass_tracker->upgradePassState($pass_no);
        $passenger = $this->passenger_tracker->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [1,$passenger->getUserId(),$pass->getPassNo(),$pass->getBusRoute(), $pass->getStartDate(), $pass->getEndDate()];
        // Final Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(),$passenger->getTelephone(),$param);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function declinePass($pass_no)
    {
        $_SESSION['success'] = "Pass declined successfully";
        $pass = $this->pass_tracker->declinePass($pass_no);
        $passenger = $this->passenger_tracker->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [2,$pass->getPassNo()];
        // Final Decline Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(),$passenger->getTelephone(),$param);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function removePass($pass_no)
    {
        $this->pass_tracker->declinePass($pass_no);
        $_SESSION['success'] = "Pass removed successfully";

        $pass = $this->pass_tracker->declinePass($pass_no);
        $passenger = $this->passenger_tracker->getPassengerByPassengerNo($pass->getPassengerNo());
        $param = [2,$pass->getPassNo()];
        // Final Decline Approval Notification
        Notification_handler::setupNotification($passenger->getEmail(),$passenger->getTelephone(),$param);

        header("Location: ../board_manager_pass_details.php");
    }

    public function checkCondcutorAccount($conductor_id)
    {
        $pattern = "/1111/i";
        if (preg_match($pattern, $conductor_id))
            return true;
        return false;
    }

    public function checkNumbersOnly($conductor_id)
    {
        $pattern = "/^\d+$/";
        if (preg_match($pattern, $conductor_id))
            return true;
        return false;
    }

    public function checkEmpty($conductor_id)
    {
        if(!empty($conductor_id))
            return true;
        return false;
    }

    public function validateConductorID($conductor_id)
    {   
        $error = "None";
        if($this->checkEmpty($conductor_id)==false)
            $error = "Empty Filed!!";
        else if($this->checkNumbersOnly($conductor_id)==false)
            $error = "Please Enter a Number!!";
        else if($this->checkCondcutorAccount($conductor_id)==false)
            $error = "Please Enter a Conductor Account!!";
        return $error;
    }

    public function checkConductorAccountExist($conductor_obj){
        
        if (empty($conductor_obj->getFirstName()) && empty($conductor_obj->getLastName()) )
        {
            $error = "Conductor Account Doesn't Exist!!";
            header("Location: board_manager_conductor_details.php?show=$error");
        }
    }

    public function getBookingDateRange($booking_no){
        $booking = $this->booking_tracker->getBooking($booking_no);
        $date_range = array("start_date" => $booking->getStartDate(), "end_date" => $booking->getEndDate());
        return $date_range;
    }

    public function allocateConductorForBooking($booking_no, $conductor_no){
        $bookings_for_conductor = $this->booking_tracker->getBookingsForConductor_FromGivenDate($conductor_no);
        $selected_booking = $this->booking_tracker->getBooking($booking_no);
        $available = true;
        foreach ($bookings_for_conductor as $booking) {
            if ((strtotime($booking->getStartDate()) >= strtotime($selected_booking->getStartDate()) && strtotime($booking->getStartDate()) <= strtotime($selected_booking->getStartDate())) ||
                (strtotime($booking->getEndDate()) >= strtotime($selected_booking->getEndDate()) && strtotime($booking->getEndDate()) <= strtotime($selected_booking->getEndDate()))) {
                $available = false;
            }
        }
        if($available){
            $this->allocateConductorForBookingFromModel($booking_no,$conductor_no);
            
            $booking = Booking_Tracker::getInstance()->getBooking($booking_no);
            $executive = Booking_Tracker::getInstance()->getExecutiveFromBookingNumber($booking_no);
            $service = Booking_Tracker::getInstance()->getServiceFromBookingNumber($booking_no);
            $param = [8,$service->getName(), $booking->getBookingNo(), $this->getBookedVehicleNo($booking),"#seats placeholder#", $booking->getPickupLocation(), $booking->getDestinationLocation()];
            // Allocated Booking Notification
            Notification_handler::setupNotification($executive->getEmail(),$executive->getTelephone(),$param);

            $_SESSION['success'] = "Selected vehicle allocated for booking";
        }else{
            $_SESSION["error"] = "This vehicle currently unavailable";
            header("Location: ../board_manager_allocate_vehicle_select.php?booking_no={$_GET['booking_no']}&pickup={$_GET['pickup']}");
        }

    }

    public function getBookedVehicleNo($booking){
        $vehicle_no ="-";
        if($booking->getState()==1){
            $conductor_obj = $this->conductor_tracker->getConductorbyNumber($booking->getBookedConductorNo());
            $vehicle_no = $conductor_obj->getVehicleNo();
        }
        return $vehicle_no;
    }

    public function remove_Conductor($conductor_id)
    {
        $conductor = $this->conductor_tracker->getConductor($conductor_id);
        $bookings = $this->booking_tracker->getBookingsForConductor_FromGivenDate($conductor->getConductorNo());
        foreach ($bookings as $booking){
            $this->conductor_tracker->cancel_Booking($booking->getBookingNo());
        }
        $this->conductor_tracker->removeConductor($conductor_id);
    }
}
