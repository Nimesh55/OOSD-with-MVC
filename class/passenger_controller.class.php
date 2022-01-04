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

    public function validate($details)
    {
        if(isset($details['fname'])) $this->is_valid_fname($details['fname']);
        if(isset($details['lname'])) $this->is_valid_lname($details['lname']);
        if(isset($details['user_id'])) {
            $this->is_valid_nic($details['user_id']);
        }
        else{
            $this->error='* Enter valid password!!! ';
        }
        if(isset($details['address'])) $this->is_valid_address($details['address']);
        if(isset($details['email'])) $this->is_valid_email($details['email']);
        if(isset($details['telephone'])) $this->is_valid_telephone($details['telephone']);
        if(isset($details['state'])) $this->is_valid_state($details['state']);
        if(isset($details['password'])) {
            $this->is_valid_password($details['password']);
        }else{$this->error.='*Enter valid password!!! ';}
        return $this->error;
    }
    //Validate NIC

    private function is_valid_nic($nic)
    {
        $result = true;
        if ($nic != "") {
            if (strlen($nic) <> 10) {
                $result = FALSE;
            }

            $nic_9 = substr($nic, 0, 9);

            if (!is_numeric($nic_9)) {
                $result = false;
            }

            $nic_v = substr($nic, 9, 1);
            if (is_numeric($nic_v)) {
                $result = false;
            }
        }
        return $result?"":'*Please Enter Valid NIC!!! ';

    }

    private function is_valid_fname($fname)
    {
        if (empty($fname)) {
            $this->error .= '* Please enter first name!!! ';
        }
    }
    private function is_valid_lname($lname)
    {
        if (empty($lname)) {
            $this->error .= '* Please enter last name!!! ';
        }
    }
    private function is_valid_address($address)
    {
        if (empty($address)) {
            $this->error .= '* Please enter the address!!! ';
        }
    }
    private function is_valid_email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->error .= '* Please insert valid email!!! ';
        }
    }
    private function is_valid_telephone($telephone)
    {
        if (!is_numeric($telephone) or strlen($telephone) != 10) {
            $this->error .= "* Enter correct telephone number!!! ";
        }
    }
    private function is_valid_state($state)
    {
        if ((0 <= $state) && ($state <= 2)) {
            $this->error .= "* Invalid State!!! ";
        }
    }
    private function is_valid_password($password){
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) >= 8 && $number && $uppercase && $lowercase && $specialChars) {
            return true;
        } else {
            return false;
        }
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
        parent::unSetCompanyDetails(); // TODO: Change the autogenerated stub
    }
    public function setPassengerState($state, $passenger_no){
        $this->setPassengerStateinTable($state, $passenger_no);
    }
}