<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
// Tracker Class Singleton
class Pass_Tracker extends Tracker{
    private static  $instance = null;

    private function __construct(){

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Pass_Tracker();
        }
        return self::$instance;
    }

    //returns a Pass object with details
    public function getPass($pass_no){
        $pass = new Pass();
        $details = Pass_Controller::getInstance()->getPassDetails($pass_no);
        $pass->setValues($pass_no, $details["passenger_no"], $details["service_no"], $details["start_date"],
                        $details["end_date"], $details["state"], $details["bus_route"], $details["reason"]);
        return $pass;
    }

    //create a new pass
    public function createPass($details){
        $pass_no = Pass_Controller::getInstance()->addNewPass(
            $details['passenger_no'],
            $details['service_no'],
            $details['start_date'],
            $details['end_date'],
            $details['state'],
            $details['bus_route'],
            $details['reason']);
        $pass = new Pass();
        $pass->setValues(
            $pass_no,
            $details['passenger_no'],
            $details['service_no'],
            $details['start_date'],
            $details['end_date'],
            $details['state'],
            $details['bus_route'],
            $details['reason']);
        return $pass;
    }

    //Approve an Essential Service
    public function upgradePassState($pass_no){
        Pass_Controller::getInstance()->upgradeState($pass_no);
    }

    public function declinePass($pass_no){
        Pass_Controller::getInstance()->setStateDeclined($pass_no);
    }


    public function getPendingPassesSearchArray(){
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getPendingPassesSearchArray();

        foreach ($passes as $pass){
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }


    public function getApprovedPassesSearchArray(){
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getApprovedPassesSearchArray();

        foreach ($passes as $pass){
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }

    public function getPassesArrayForService($service_no){
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getPassesArrayForService($service_no);

        foreach ($passes as $pass){
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }

    public function getPassOwner($pass_no){
        
        return "pass owner name/username";
    }

    public function getPass_by_passenger_id($passenger_id){
        $pass = new Pass();

        $details = Pass_Controller::getInstance()->getPassby_passenger_id($passenger_id);

        if (empty($details)) {
            return 0;
        }

        $pass->setValues($details["pass_no"], $details["passenger_no"], $details["service_no"], $details["start_date"],
                        $details["end_date"], $details["state"], $details["bus_route"], $details["reason"]);
        
        $pass_details = array(
            "passenger_name" => $details["first_name"]." ".$details["last_name"],
            "company_name" => $details["name"],
            "passObj" => $pass 
        );

        return $pass_details;
    }

}