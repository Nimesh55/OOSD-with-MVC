<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Booking_Controller extends Booking_Model{

    private static  $instance;

    private function __construct()
    {

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Booking_Controller();
        }
        return self::$instance;
    }

    public function getBookingDetails($booking_no){
        return $this->getBookingDetailsFromModel($booking_no);
    }

    public function getBookingState($booking_no){
        return $this->getBookingStateFromModel($booking_no);
    }

    public function setStateApproved($booking_no){
        $this->setStateApproveedFromModel($booking_no);
    }

    public function setStateExpired($booking_no){
        $this->setStateExpiredFromModel($booking_no);
    }

    public function setStateCanelled($booking_no){
        $this->setStateCanelledFromModel($booking_no);
    }

    public function getCurrentBookingsCount(){
        return $this->getCurrentBookingsCountFromModel();
    }

    public function addNewBooking($booking_no, $service_no, $start_date, $end_date, $pickup_district,
                                  $destination_district, $state, $booked_conductor_no){
        return $this->addNewBookingFromModel($booking_no, $service_no, $start_date, $end_date, $pickup_district,
                                                $destination_district, $state, $booked_conductor_no);
    }

    public function getBookingsArray(){
        return $this->getBookingsArrayFromModel();
    }

}