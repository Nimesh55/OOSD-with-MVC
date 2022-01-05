<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";


class Conductor_Controller extends Conductor_Model
{

    public function __construct()
    {
    }

    public function getConductor_by_conductor_no($conductor_no)
    {
        $data = $this->getConductor_ByConductorNo($conductor_no);
        $conductor_id  = $data["user_id"];
        // echo $conductor_id;

        $condObject = new Conductor($conductor_id);
        return $condObject;
    }

    public function checkPassengerAccount($passenger_id)
    {
        $pattern = "/0000/i";
        if (preg_match($pattern, $passenger_id))
            return true;
        return false;
    }

    public function checkNumbersOnly($passenger_id)
    {
        $pattern = "/^\d+$/";
        if (preg_match($pattern, $passenger_id))
            return true;
        return false;
    }

    public function checkEmpty($passenger_id)
    {
        if (!empty($passenger_id))
            return true;
        return false;
    }

    public function validatePassengerId($passenger_id)
    {
        $error = "None";
        if ($this->checkEmpty($passenger_id) == false)
            $error = "Empty Filed";
        else if ($this->checkNumbersOnly($passenger_id) == false)
            $error = "Please Enter a Numbers only";
        else if ($this->checkPassengerAccount($passenger_id) == false)
            $error = "Please Enter a Passenger Account";
        return $error;
    }

    public function checkPassExist($pass_details_array)
    {

        if (empty($pass_details_array)) {
            $error = "Pass Doesn't Exist!!";
            header("Location: conductor_verify_passenger.php?show='{$error}'");
            return;
        }
    }

    public function getConductorsArrayByDistrict($district_no)
    {
        return $this->getConductorsArrayByDistrictFromModel($district_no);
    }

    public function updateLeave($conductor_no, $date, $type)
    {
        $isBooked = Conductor_Tracker::getInstance()->checkBooking($conductor_no, $date, $type);
        $isLeaveExist = $this->checkLeaveExist_FromModel($conductor_no, $date);

        if (!empty($isLeaveExist)) {
            $error = "Leave Already Created with that Date!!";
            header("Location: ../conductor_update_leave.php?error='{$error}'");
            return;
        } elseif ($isBooked == true && empty($isLeaveExist)) {
            $error = "Booking has been made. Try another date!!";
            header("Location: ../conductor_update_leave.php?error='{$error}'");
            return;
        } elseif ($isBooked == false && empty($isLeaveExist)) {
            $this->updateLeaveFromModel($conductor_no, $date);
            $error = "Leave Granted!!";
            header("Location: ../conductor_update_leave.php?error='{$error}'");
            return;
        }
    }

    public function getConductorLeavesArray($conductor_no)
    {
        return $this->getConductorLeavesArrayFromModel($conductor_no);
    }

    //achira
    public function getConductorBookings($conductor_no)
    {
        return Booking_Tracker::getInstance()->getBookingsForConductor($conductor_no);
    }

    public function getBooking($bookingNo)
    {
        return Booking_Tracker::getInstance()->getBooking($bookingNo);
    }

    public function getEssentialServiceName($serviceNo)
    {
        return Conductor_Tracker::getInstance()->getEssentialServiceName($serviceNo);
    }

    public function getDistrictName($district_no)
    {
        $z = $this->getDistrictNameFromModel($district_no);
        return $z;
    }

    public function cancelBooking($bookingNo)
    {
        $contactDetailsArray = array();
        array_push($contactDetailsArray, "+94778665718");
        array_push($contactDetailsArray, "sathira.19@cse.mrt.ac.lk");
        $mesb = "This is to inform you that Boooking No.".$bookingNo." has been cancelled by the Conductor!";
        $ems = "Cancellation of Booking No.".$bookingNo;

        notification_handler::sendNotification($contactDetailsArray, $mesb, $ems);

        Conductor_Tracker::getInstance()->cancel_Booking($bookingNo);
        return;
    }

    public function getBookings_ForConductor_FromGivenDate($conductor_no)
    {
        return Conductor_Tracker::getInstance()->getBookingsFor_ConductorNo_FromGivenDate($conductor_no);
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

    public function remove_conductor($conductor_id)
    {
        $this->remove_conductor_FromModel($conductor_id);
    }

}
