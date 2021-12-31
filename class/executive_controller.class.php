<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive_Controller extends Executive_Model
{
    private $executive;
    private $pass_tracker;
    private $passenger_tracker;
    private $conductor_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
        $this->passenger_tracker = Passenger_Tracker::getInstance();
        $this->conductor_tracker = Conductor_Tracker::getInstance();
    }


    public function setUpDetails()
    {
        $details = $this->getRecord($_SESSION['user_Id']);
        $this->executive = new Executive();
        $this->executive->setValues($details['user_id'], $details['executive_no'], $details['first_name'],
                                    $details['last_name'], $details['address'], $details['telephone'],
                                    $details['service_no'], $details['email'], $details['state']);
        return $this->executive;
    }

    public function validatedetails($details)
    {
        //validate details and give feedback
        if (empty($details['fname']) && empty($details['lname'])) {
            $_SESSION["error"] = 'Please enter first name and last name!!!';
        }elseif(empty($details['address'])){
            $_SESSION["error"] = 'Please enter address!!!';
        }elseif(filter_var($details['email'], FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION["error"] = 'Please insert valid email!!!';
        }elseif (!is_numeric($details['telephone']) or strlen($details['telephone'])!=10) {
            $_SESSION["error"] = "Enter correct telephone number!!!";
        }
        if(!isset($_SESSION["error"])){
            $this->changeDetails($details);
        }
    }

    public function approvePass($pass_no){
        $this->pass_tracker->upgradePassState($pass_no);
        header("Location: ../executive_pass_details.php");
    }

    public function declinePass($pass_no){
        $this->pass_tracker->declinePass($pass_no);
        header("Location: ../executive_pass_details.php");
    }

    public function getBusNo($conductor_no, $booking_state){
        $conductor = $this->conductor_tracker->getConductor($conductor_no);
        $bus_no =null;
        if($booking_state>0){
            $bus_no = $conductor->getvehicle_no();
        }
        return $bus_no;
    }

    public function getPassStatus($state){
        if ($state == 0) {
            $status = "Pending";
        } elseif ($state == 1) {
            $status = "Accepted-1";
        } elseif ($state == 2) {
            $status = "Accepted-2";
        } else {
            $status = "Declined";
        }
        return $status;
    }

    public function getServiceStatus($id){
        $state = EssentialServiceTracker::getInstance()->getServiceStatus($id);
        if ($state == 0) {
            $status = "Non-Essential";
        } elseif ($state == 1) {
            $status = "Pending";
        } elseif ($state == 2) {
            $status = "Essential";
        } else {
            $status = "Removed";
        }
        return $status;
    }

    public function getAllPassengers($service_no){
        $passenger_no_array = $this->getPassengerNumbers_inService($service_no); // gets the passenger numbers for the passengers requesting or approved by this service
        
        // creates an array of passenger objects via passenger tracker of the above passenger numbers 
        $passengerArray = array();
        for ($i=0; $i < count($passenger_no_array); $i++) { 
            $curpassengerno = $passenger_no_array[$i];
            $cur = $this->passenger_tracker->getPassengerByPassengerNo($curpassengerno['passenger_no']);
            $passengerArray[$i] = $cur;

        }
        return $passengerArray;
    }

    //used to set state within the executive dashboard approve, decline, remove
    public function setPassengerState($state, $passenger_no){
        $this->passenger_tracker->setPassengerState($state, $passenger_no);
        header("Location: ../executive_passenger_details.php");
    }
}
