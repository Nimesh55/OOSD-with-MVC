<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive_Controller extends Executive_Model
{
    private $executive;

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
        Pass_Tracker::getInstance()->upgradePassState($pass_no);
        header("Location: ../executive_pass_details.php");
    }

    public function declinePass($pass_no){
        Pass_Tracker::getInstance()->declinePass($pass_no);
        header("Location: ../executive_pass_details.php");
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
            $cur = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($curpassengerno['passenger_no']);
            $passengerArray[$i] = $cur;

        }
        return $passengerArray;
    }

    //used to set state within the executive dashboard approve, decline, remove
    public function setPassengerState($state, $passenger_no){
        Passenger_Tracker::getInstance()->setPassengerState($state, $passenger_no);
        header("Location: ../executive_passenger_details.php");
    }

    public function getBusNo($booking){
        $bus_no = "";
        if ($booking->getState()>0){
            $conductor = Conductor_Tracker::getInstance()->getConductorByNumber($booking->getBookedConductorNo());
            if($conductor!=null)
                $bus_no = $conductor->getVehicleNo();
        }
        return $bus_no;
    }

    public function requestBooking($details){

        if($this->validateRequestBooking($details)){
            Booking_Tracker::getInstance()->createBooking($details);
            header("Location: ../executive_booking_details.php");
        }else{
            header("Location: ../executive_request_booking.php");
        }


    }

    public function validateRequestBooking($details){

        if(empty($details['reason'])||empty($details['start_date'])||empty($details['end_date'])||empty($details['start_time'])||
            empty($details['end_time'])||empty($details['pickup_district'])||empty($details['destination_district'])||
            empty($details['destination_location'])||empty($details['passenger_count'])){
            $_SESSION["error"] = 'Please fill all fields';
        }elseif((strtotime($details['start_date'])<strtotime("now"))||(strtotime($details['start_date'])>strtotime($details['end_date']))) {
            $_SESSION["error"] = 'Invalid dates. Check your dates again and try again';
        }elseif (strtotime($details['start_time'])>strtotime($details['end_time'])){
            $_SESSION["error"] = 'Invalid times. Check your times again and try again';
        }elseif (is_numeric( $details['passenger_count'] ) && floor( $details['passenger_count'] ) != $details['passenger_count']){
            $_SESSION["error"] = 'Invalid passenger count. Enter valid passenger count and try again';
        }elseif ($details['passenger_count']<0 || $details['passenger_count']>30){
            $_SESSION["error"] = 'Passenger count must be in between 0 and 30. Enter valid passenger count and try again';
        }

        if(isset($_SESSION["error"]))
            return false;
        return true;
    }

    //Setting up Passes of state: Pending, Accepted-1, Accepted-2 for the relavent Service in executive dashboard
    public function get_PassesForDashboard($service_no){
        $passes = Pass_Tracker::getInstance()->getPassesArrayForService($service_no);
        $finalPasses = array();
        foreach($passes as $currentPass){
            if($currentPass->getState()<3){ // Filters in state 0,1,2
                array_push($finalPasses,$currentPass);
            }
        }
        return $finalPasses;
    }

    public function setEssentialServiceState($state, $service_no)
    {
        print_r($_FILES);
        //exit();
        if(isset($_FILES["file"]) && $_FILES['file']['name']!=null){
            $last_no = File_Controller::getInstance()->uploadFile();
            EssentialServiceTracker::getInstance()->setFileNo($last_no,$service_no);
        }else{
            EssentialServiceTracker::getInstance()->setFileNo(null,$service_no);
        }
        //echo "s=".$state." & ser no=".$service_no;
        EssentialServiceTracker::getInstance()->setState($state, $service_no);
    }

    public function setExecutiveState($state, $service_no)
    {
        if ($state == 0) {
            $this->setStateUnregistered_using_ServiceNo_FromModel($service_no);
        }
        else if ($state == 1) {
            if(isset($_FILES["file"]) && $_FILES['file']['name']==null){
                $this->setStatePending_using_ServiceNo_FromModel($service_no);
            }
            else{
                $this->setStatePending_using_ServiceNo_FromModel_WithFile($service_no);
            }
        }
        else if($state == 2){
            $this->setStateRegistered_using_ServiceNo_FromModel($service_no);
        }
        
    }

    public function setBookingCompleted($booking_no){
        Booking_Tracker::getInstance()->cancelBookingByExecutive($booking_no);
        $_SESSION['success'] = "Booking cancelled";
    }
}
