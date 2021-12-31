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
        $this->setStateApprovedFromModel($booking_no);
    }

    public function setStateExpired($booking_no){
        $this->setStateExpireedFromModel($booking_no);
    }

    public function setStateCanelled($booking_no){
        $this->setStateCanelledFromModel($booking_no);
    }

    public function getCurrentBookingsCount(){
        return $this->getCurrentBookingsCountFromModel();
    }

    public function addNewBooking($service_no, $reason, $start_date, $end_date, $start_time, $end_time, $pickup_district,
                                  $pickup_location, $destination_district, $destination_location, $passenger_count){
        return $this->addNewBookingFromModel($service_no, $reason, $start_date, $end_date, $start_time, $end_time, $pickup_district,
                                            $pickup_location, $destination_district, $destination_location, $passenger_count);
    }

    public function getBookingsArray(){
        return $this->getBookingsArrayFromModel();
    }

    public function getBookingsArrayForService($service_no){
        return $this->getBookingsArrayForServiceFromModel($service_no);
    }

}