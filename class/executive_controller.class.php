<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive_Controller extends Executive_Model
{
    private $executive;
    private $pass_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
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
    /////////////////////////////////////////////////////////////////////////////////////////////
    public function approvePass($pass_no){
        $this->pass_tracker->upgradePassState($pass_no);
        header("Location: executive_pass_details.php");
    }

    public function declinePass($pass_no){
        $this->pass_tracker->declinePass($pass_no);
        header("Location: executive_pass_details.php");
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    //Try to run this directly
    public function passApproveDecline($pass_no){
        if ($_GET['action']=='accept') {
            $this->pass_tracker->upgradePassState($pass_no);
        }elseif($_GET['action']=='decline') {
            $this->pass_tracker->declinePass($pass_no);
        }
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

}

?>
