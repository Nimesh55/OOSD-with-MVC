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
        $passObj = $this->getPass($pass_no);
        $state = $passObj->getState();
        if ($state == 0)
            Pass_Controller::getInstance()->setPassStateAccept_oneCtrl($passObj->getPassNo());
        elseif ($state == 1)
            Pass_Controller::getInstance()->setPassStateAccept_twoCtrl($passObj->getPassNo());
        return $passObj; //used in Notifications
    }

    public function declinePass($pass_no)
    {
        $passObj = $this->getPass($pass_no);
        Pass_Controller::getInstance()->setStateDeclined($passObj->getPassNo());
        return $passObj;
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

        $my_iterator = new My_Iterator($passes);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($passes_arr,$this->getPass($my_iterator->current()['pass_no']));
        }

        return $passes_arr;
    }


    public function getApprovedPassesSearchArray()
    {
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getApprovedPassesSearchArray();

        $my_iterator = new My_Iterator($passes);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($passes_arr,$this->getPass($my_iterator->current()['pass_no']));
        }

        return $passes_arr;
    }

    public function getPassesArrayForService($service_no)
    {
        $passes_arr = array();
        $passes = Pass_Controller::getInstance()->getPassesArrayForService($service_no);

        $my_iterator = new My_Iterator($passes);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($passes_arr,$this->getPass($my_iterator->current()['pass_no']));
        }



        return $passes_arr;
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

        $my_iterator = new My_Iterator($passesArray);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($passesObjArray, $this->getPass($my_iterator->current()['pass_no']));
        }



        return $passesObjArray;
    }

    // Called in Timer Observable
    public function update($curDate){
        $change=0;
        $passesArray = $this->getAllPasses();

        $my_iterator = new My_Iterator($passesArray);
        for(;$my_iterator->valid();$my_iterator->next()){
            $pass = $my_iterator->current();
            $passEndDate = $pass->getEndDate();
            if ($curDate > $passEndDate) {
                $this->setPassStateExpired($pass->getPassNo());
                //Expire Pass Notification
                $passenger = Passenger_Tracker::getInstance()->getPassengerByPassengerNo($pass->getPassengerNo());
                $param = [5, $pass->getPassNo()];
                Notification_handler::setupNotification($passenger->getEmail(),$passenger->getTelephone(),$param);
                $change++;
            }
        }

        return $change;
    }
    public function searchForActivePass($passenger_no){
        $pass_controller = Pass_Controller::getInstance();
        return $pass_controller->searchForActivePass($passenger_no);
    }

    public function getActivePassForPassenger($passenger_no){
        $pass_details = $this->searchForActivePass($passenger_no);
        if($pass_details==null){
            return null;
        }
        return $this->getPass($pass_details['pass_no']);
    }
}
