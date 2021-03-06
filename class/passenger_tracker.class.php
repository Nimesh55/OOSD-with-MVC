<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

class Passenger_Tracker extends Tracker
{
    private static  $instance = null;
    private Passenger_Controller $passenger_ctrl;


    private function __construct()
    {
        $this->passenger_ctrl = new Passenger_Controller();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Passenger_Tracker();
        }
        return self::$instance;
    }

    public function getPassengerByPassengerNo($passenger_no)
    {
        return $this->getPassenger($this->passenger_ctrl->getPassengerUserId($passenger_no));
    }

    public function getPassenger($user_id)
    {
        $passenger = Passenger::getInstance($user_id);
        $passenger_controller = new Passenger_Controller();
        $passenger_controller->setPassengerDetails($passenger);
        return $passenger;
    }

    public function setPassengerState($state, $passenger_no)
    {
        $this->passenger_ctrl->setPassengerState($state, $passenger_no);

        $passenger = $this->getPassengerByPassengerNo($passenger_no);
        //Accept/Decline Passenger Account Notification
        if ($state == 2) {
            $service = EssentialServiceTracker::getInstance()->getServiceName($passenger->getServiceNo());
            $param = [11, $service, $passenger->getUserId(), $passenger->getFirstName() . " " . $passenger->getLastName(), $passenger->getStaffId()];
            Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);
        } else if ($state == 0) {
            $param = [12, $passenger->getUserId(), $passenger->getFirstName() . " " . $passenger->getLastName(), $passenger->getStaffId()];
            Notification_handler::setupNotification($passenger->getEmail(), $passenger->getTelephone(), $param);
            //Remove passes related to this passenger
            $pass = Pass_Tracker::getInstance()->getActivePassForPassenger($passenger_no);
            if (isset($pass)) {
                Pass_Tracker::getInstance()->declinePass($pass->getPassNo());
            }
            
        }
    }

    public function getPassengersInService($service_no)
    {
        $passengers_in_service = array();
        $passengers_in_company_details = $this->passenger_ctrl->getAllPassengersInService($service_no);

        $my_iterator = new My_Iterator($passengers_in_company_details);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($passengers_in_service, $this->getPassengerByPassengerNo($my_iterator->current()['passenger_no']));
        }


        return $passengers_in_service;
    }

    public function setPassengerServiceNo($service_no, $passengerObj){
        $this->passenger_ctrl->setPassengerServiceNo($service_no, $passengerObj);
    }
}
