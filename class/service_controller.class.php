<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Service_Controller extends Service_Model {

    public function __construct()
    {
        
    }

    public function setState($state, $service_no)
    {
        if ($state == 0) {
            $this->setStateNonEssential_using_ServiceNo_FromModel($service_no);
        }
        else if ($state == 1) {
            $this->setStatePending_using_ServiceNo_FromModel($service_no);
        }
        else if($state == 2){
            $this->setStateEssential_using_ServiceNo_FromModel($service_no);
        }
        else if ($state == 3) {
            $this->setStateRemoved_using_ServiceNo_FromModel($service_no);
        }
    }


}