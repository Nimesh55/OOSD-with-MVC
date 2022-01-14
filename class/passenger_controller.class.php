<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Passenger_Controller extends Passenger_Model
{
    private $error='';
    function __construct()
    {
    }

    public function setPassengerDetails(Passenger $passenger){
        $row = $this->getRecord($passenger->getUserId());
        $passenger->setPassengerNo($row['passenger_no']);
        $passenger->setFirstName($row['first_name']);
        $passenger->setLastName($row['last_name']);
        $passenger->setAddress($row['address']);
        $passenger->setTelephone($row['telephone']);
        $passenger->setServiceNo($row['service_no']);
        $passenger->setStaffId($row['staff_id']);
        $passenger->setEmail($row['email']);
        $passenger->setState($row['state']);
        $passenger->setFileNo($row['file_no']);
    }

    public function validatedetails($details)
    {
        //validate details and give feedback
        if (empty($details['fname']) && empty($details['lname'])) {
            $_SESSION["error"] = 'Please enter first name and last name!!!';
        } elseif (empty($details['address'])) {
            $_SESSION["error"] = 'Please enter address!!!';
        } elseif (filter_var($details['email'], FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION["error"] = 'Please insert valid email!!!';
        } elseif (!is_numeric($details['telephone']) or strlen($details['telephone']) != 10) {
            $_SESSION["error"] = "Enter correct telephone number!!!";
        }
        if (!isset($_SESSION["error"])) {
            $this->changeDetails($details);
        }
    }

    public function createUsername($passenger)
    {
        return $passenger->getFirstName() . " " . $passenger->getLastName();
    }


    public function getPassengerUserId($passenger_no){
        return $this->getUserId($passenger_no);
    }
    
    public function setPassengerCompanyDetails($service_no,$staff_id){
        if(isset($_FILES["file"]) && $_FILES['file']['name']==null){
            $this->setCompanyDetails($service_no,$staff_id);
        }
        else{
            $last_no = File_Controller::getInstance()->uploadFile();
            $this->setCompanyDetailsWithFile($service_no, $staff_id, $last_no);
        }
    }
    public function unSetPassengerCompanyDetails()
    {
        //parent::unSetCompanyDetails(); 
        $this->unSetCompanyDetails();

        //Removes related Passes
        $passengerObj = Passenger_Tracker::getInstance()->getPassenger($_SESSION['user_Id']);
        $passObj = Pass_Tracker::getInstance()->getActivePassForPassenger($passengerObj->getPassengerNo());
        if (isset($passObj)) {
            Pass_Tracker::getInstance()->declinePass($passObj->getPassNo());
        }
    }
    public function setPassengerState($state, $passenger_no){
        $this->setPassengerStateinTable($state, $passenger_no);
    }

    public function setPassengerServiceNo($service_no, $passengerObj){
        $this->setPassengerServiceNo_model($service_no, $passengerObj->getPassengerNo());
    }

    public function getAllPassengersInService($service_no){
        return $this->getAllPassengersInServiceFromModule($service_no);
    }
}