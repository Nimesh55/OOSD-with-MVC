<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model
{

    private $pass_tracker;
    private $booking_tracker;
    private $conductor_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->booking_tracker = Booking_Tracker::getInstance();
        $this->conductor_tracker = Conductor_Tracker::getInstance();
    }

    public function approvePass($pass_no)
    {
        $this->pass_tracker->upgradePassState($pass_no);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function declinePass($pass_no)
    {
        $this->pass_tracker->declinePass($pass_no);
        header("Location: ../board_manager_pending_passes.php");
    }

    public function removePass($pass_no)
    {
        $this->pass_tracker->declinePass($pass_no);
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
        
        if (empty($conductor_obj->getfirst_name()) && empty($conductor_obj->getlast_name()) )
        {
            $error = "Conductor Account Doesn't Exist!!";
            header("Location: board_manager_conductor_details.php?show='{$error}'");
            return;
            
        }
    }

    public function getBookingDateRange($booking_no){
        $booking = $this->booking_tracker->getBooking($booking_no);
        $date_range = array("start_date" => $booking->getStartDate(), "end_date" => $booking->getEndDate());
        return $date_range;
    }

    public function allocateConductorForBooking($booking_no, $conductor_no){
        $this->allocateConductorForBookingFromModel($booking_no,$conductor_no);
    }

    public function getBookedVehicleNo($booking){
        $vehicle_no ="-";
        if($booking->getState()==1){
            $conductor_obj = $this->conductor_tracker->getConductorbyNumber($booking->getBookedConductorNo());
            $vehicle_no = $conductor_obj->getvehicle_no();
        }
        return $vehicle_no;
    }
}
