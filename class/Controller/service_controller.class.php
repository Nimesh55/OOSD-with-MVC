<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Service_Controller extends Service_Model {

    public function __construct()
    {
        
    }

    //Only used for Executive
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
        
    }

    public function setFileNo($last_no,$service_no){
        $this->setFileNo_FromModel($last_no,$service_no);
    }


}