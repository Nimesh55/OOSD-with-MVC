<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Pass_Controller extends Pass_Model{

    private static  $instance;

    private function __construct()
    {

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Pass_Controller();
        }
        return self::$instance;
    }

    public function getPassDetails($pass_no){
        return $this->getPassDetailsFromModel($pass_no);
    }

    public function getPassState($pass_no){
        return $this->getPassStateFromModel($pass_no);
    }

    public function setPassStateAccept_oneCtrl($pass_no){
        $this->setPassStateAccept_one($pass_no);
    }

    public function setPassStateAccept_twoCtrl($pass_no){
        $this->setPassStateAccept_two($pass_no);
    }

    public function setStatePending($pass_no){
        $this->setStatePendingFromModel($pass_no);
    }

    public function setStateExpired($pass_no){
        $this->setStateExpiredFromModel($pass_no);
    }

    public function setStateDeclined($pass_no){
        $this->setStateDeclinedFromModel($pass_no);
    }

    public function addNewPass($passenger_no, $service_no, $start_date, $end_date, $bus_route, $reason){
        return $this->addNewPassFromModel($passenger_no, $service_no, $start_date, $end_date, $bus_route, $reason);
    }

    public function getPendingPassesSearchArray(){
        return $this->getPendingPassesSearchArrayFromModel();
    }

    public function getApprovedPassesSearchArray(){
        return $this->getApprovedPassesSearchArrayFromModel();
    }

    public function getPassesArrayForService($service_no){
        return $this->getPassesArrayForServiceFromModel($service_no);
    }

    public function getCurrentPassesCount(){
        return $this->getCurrentPassesCountFromModel();
    }

    public function getPassby_passenger_id($passenger_id)
    {
        return $this->getPassby_passenger_id_model($passenger_id);

    }
}