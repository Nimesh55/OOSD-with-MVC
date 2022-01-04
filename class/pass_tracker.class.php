<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/class/observer.interface.php";
// Tracker Class Singleton
class Pass_Tracker extends Tracker implements Observer
{
    private static  $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Pass_Tracker();
        }
        return self::$instance;
    }

    //returns a Pass object with details
    public function getPass($pass_no)
    {
        $pass = new Pass();
        $details = Pass_Controller::getInstance()->getPassDetails($pass_no);
        $pass->setValues(
            $pass_no,
            $details["passenger_no"],
            $details["service_no"],
            $details["start_date"],
            $details["end_date"],
            $details["state"],
            $details["bus_route"],
            $details["reason"],
            $details["file_no"]
        );
        return $pass;
    }

    //create a new pass
    public function createPass($details)
    {
        $pass_no = Pass_Controller::getInstance()->addNewPass(
            $details['passenger_no'],
            $details['service_no'],
            $details['start_date'],
            $details['end_date'],
            $details['bus_route'],
            $details['reason']
        );
        $pass = new Pass();
        $pass->setValues(
            $pass_no,
            $details['passenger_no'],
            $details['service_no'],
            $details['start_date'],
            $details['end_date'],
            $details['state'],
            $details['bus_route'],
            $details['reason'],
            $details['file_no']
        );
        return $pass;
    }

    //Approve an Essential Service
    public function upgradePassState($pass_no)
    {
        $state = Pass_Controller::getInstance()->getPassState($pass_no);
        if ($state == 0)
            Pass_Controller::getInstance()->setPassStateAccept_oneCtrl($pass_no);
        elseif ($state == 1)
            Pass_Controller::getInstance()->setPassStateAccept_twoCtrl($pass_no);
    }

    public function declinePass($pass_no)
    {
        Pass_Controller::getInstance()->setStateDeclined($pass_no);
    }

    //called by timer
    public function setPassStateExpired($pass_no)
    {
        Pass_Controller::getInstance()->setStateExpired($pass_no);
    }


    public function getPendingPassesSearchArray()
    {
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getPendingPassesSearchArray();

        foreach ($passes as $pass) {
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }


    public function getApprovedPassesSearchArray()
    {
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getApprovedPassesSearchArray();

        foreach ($passes as $pass) {
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }

    public function getPassesArrayForService($service_no)
    {
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getPassesArrayForService($service_no);

        foreach ($passes as $pass) {
            array_push($passes_arr, $this->getPass($pass['pass_no']));
        }
        return $passes_arr;
    }

    public function getPassOwner($pass_no)
    {

        return "pass owner name/username";
    }

    public function getPass_by_passenger_id($passenger_id)
    {
        $pass = new Pass();

        $details = Pass_Controller::getInstance()->getPassby_passenger_id($passenger_id);

        if (empty($details)) {
            return 0;
        }

        $pass->setValues(
            $details["pass_no"],
            $details["passenger_no"],
            $details["service_no"],
            $details["start_date"],
            $details["end_date"],
            $details["state"],
            $details["bus_route"],
            $details["reason"],
            $details["file_no"]
        );

        $pass_details = array(
            "passenger_name" => $details["first_name"] . " " . $details["last_name"],
            "company_name" => $details["name"],
            "passObj" => $pass
        );

        return $pass_details;
    }

    // Used in the expire function
    public function getAllPasses()
    {
        $passesArray = Pass_Controller::getInstance()->getAllPasses_array();
        $passesObjArray = array();
        foreach ($passesArray as $pass) {
            $passObj = $this->getPass($pass['pass_no']);
            array_push($passesObjArray, $passObj);
        }
        return $passesObjArray;
    }

    // Called in Timer Observable
    public function update($curDate){
        $change=0;
        $passesArray = $this->getAllPasses();
        foreach ($passesArray as $pass) {
            $passEndDate = $pass->getEndDate();
            if ($curDate > $passEndDate) {
                $this->setPassStateExpired($pass->getPassNo());
                $change++;
            }
        }
        return $change;
    }
    public function searchForActivePass($passenger_no){
        $pass_controller = Pass_Controller::getInstance();
        return $pass_controller->searchForActivePass($passenger_no);
    }

}
