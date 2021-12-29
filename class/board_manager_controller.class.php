<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Board_Manager_Controller extends Board_Manager_Model{

    private $pass_tracker;

    public function __construct()
    {
        $this->pass_tracker = Pass_Tracker::getInstance();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    public function approvePass($pass_no){
        $this->pass_tracker->upgradePassState($pass_no);
        header("Location: board_manager_pending_passes.php");
    }

    public function declinePass($pass_no){
        $this->pass_tracker->declinePass($pass_no);
        header("Location: board_manager_pending_passes.php");
    }
    ////////////////////////////////////////////////////////////////////////////////////////

}