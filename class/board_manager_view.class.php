<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Board_Manager_View extends Board_Manager_Model{
    private $board_manager;

    public function __construct(){
        $this->board_manager = new Board_Manager();
    }
    public function getHomeDetails()
    {
        $details=array(
            "name" => $this->board_manager->getName(),
            "pending_passes_cnt"=> $this->getPendingPassesCount(),
            "approved_passes_cnt"=> $this->getApprovedPassesCount(),
            "total_conductor_cnt"=> $this->getConductorCount());
        return $details;
    }

    public function getPendingPassesDetails()
    {
        $details=array(
            "name" => $this->board_manager->getName(),
            "pendingPassesArray"=> $this->getPendingPassesArray(),
            "pendingPassesCount"=> count($this->getPendingPassesArray()));
        return $details;
    }


    public function getCreateConductorDetails(){
        $details=array(
            "name" => $this->board_manager->getName(),
            "districtArray"=> $this->getDistrictArray(),
            "districtArrayCount"=> count($this->getDistrictArray()));
        return $details;
    }

}

?>