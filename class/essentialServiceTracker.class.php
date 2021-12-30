<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
// Tracker Class Singleton
class EssentialServiceTracker extends Tracker{
    private static  $instance = null;

    private function __construct(){
    }
    
    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new EssentialServiceTracker();
        }
        return self::$instance;  
    }

    //returns a Essential Service object with details
    public function createService($service_no){
        $service = new EssentialService($service_no);
        $details = Service_Model::getInstance()->getServiceDetails($service_no);
        $service->setValues($service_no, $details["id"], $details["name"], $details["state"]);
        return $service;
    }

    //Approve an Essential Service
    public function approveService($service_no){
        Service_Model::getInstance()->setStateEssential($service_no); // fix MVC make these methods protected
    }

    //Decline an Essential Service
    public function declineService($service_no){
        Service_Model::getInstance()->setStateNonEssential($service_no);
    }

    public function getServiceStatus($serviceId){
        $x = Service_Model::getInstance()->getServiceDetails($serviceId);
        return $x['state'];
    }

}