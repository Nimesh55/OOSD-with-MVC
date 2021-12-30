<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model
{

    private $pass_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
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
}
