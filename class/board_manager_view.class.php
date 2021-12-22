<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Board_Manager_View extends Board_Manager_Model{
    private $board_manager;

    public function __construct(){
        $this->board_manager = new Board_Manager();

        echo "Board Manager view object crated";
    }
    public function getHomeDetails()
    {
        $details=array(
            "pending_passes_cnt"=> $this->getPendingPaasesCount(),
            "approved_passes_cnt"=> $this->getApprovedPaasesCount(),
            "total_conductor_cnt"=> $this->getConductorCount());
        echo "Board Manager view function called";
        return $details;
    }

}

?>