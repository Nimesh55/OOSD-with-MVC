<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
// Tracker Class Singleton
class EssentialServiceTracker extends Tracker
{
    private static  $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new EssentialServiceTracker();
        }
        return self::$instance;
    }

    //returns a Essential Service object with details
    public function createService($service_no)
    {
        $service = new EssentialService($service_no);
        $details = Service_Model::getInstance()->getServiceDetails($service_no);
        $service->setValues($service_no, $details["id"], $details["name"], $details["state"], $details['file_no']);
        return $service;
    }

    //Approve an Essential Service
    public function approveService($service_no)
    {
        $service = $this->createService($service_no);
        Service_Model::getInstance()->setStateEssential($service->getId());

        $param = [6, $service->getName(), $service->getId()];
        $executiveObj = $this->getExecutiveByServiceNo($service_no);
        Notification_handler::setupNotification($executiveObj->getEmail(), $executiveObj->getTelephone(), $param);
    }

    //Decline an Essential Service
    public function declineService($service_no)
    {
        $bookings = Booking_Tracker::getInstance()->getBookingsArrayForService($service_no);
        foreach ($bookings as $booking) {
            if ($booking->getState() < 2) {
                Booking_Tracker::getInstance()->setbookingStateExpired($booking->getBookingNo());
            }
        }

        $service = $this->createService($service_no);
        Service_Model::getInstance()->setStateNonEssential($service->getId());
        $param = [7, $service->getName(), $service->getId()];
        $executiveObj = $this->getExecutiveByServiceNo($service_no);
        Notification_handler::setupNotification($executiveObj->getEmail(), $executiveObj->getTelephone(), $param);
    }

    public function getServiceStatus($serviceId)
    {
        $x = Service_Model::getInstance()->getServiceDetails($serviceId);
        return $x['state'];
    }

    public function getServiceName($service_no)
    {
        $y = Service_Model::getInstance()->getServiceName_FromModel($service_no);
        return $y['name'];
    }

    public function setState($state, $service_no)
    {
        if ($state == 0) {
            //Remove Passengers
            $passengerArray = Passenger_Tracker::getInstance()->getPassengersInService($service_no);
            foreach($passengerArray as $passenger){
                Passenger_Tracker::getInstance()->setPassengerState(0,$passenger->getPassengerNo());
            }
            $bookingArray = Booking_Tracker::getInstance()->getBookingsArrayForService($service_no);
                Booking_Tracker::getInstance()->cancelBookingBulk($bookingArray);// test this
        }

        $ctrl_obj = new Service_Controller();
        $ctrl_obj->setState($state, $service_no);
    }

    public function setFileNo($last_no, $service_no)
    {
        $ctrl_obj = new Service_Controller();
        $ctrl_obj->setFileNo($last_no, $service_no);
    }

    public function getExecutiveByServiceNo($service_no)
    {
        $exec_ctrl = new Executive_Controller();
        return $exec_ctrl->getExecutiveNumberFromService_no($service_no);
    }
}
