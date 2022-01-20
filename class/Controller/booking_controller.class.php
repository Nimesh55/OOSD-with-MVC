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
        $this->setStateExpiredFromModel($booking_no);
    }

    public function setStateCanelled($booking_no){
        $this->setStateCanelledFromModel($booking_no);
        $_SESSION['success'] = "Booking removed successfully";
    }

    public function setStateCompleted($booking_no){
        $this->setStateCompletedFromModel($booking_no);
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

    public function getBookingsForDistrict($district_no){
        if($district_no==0){
            return $this->getBookingsArrayFromModel();
        }else{
            return $this->getBookingsArrayForPickupFromModel($district_no);
        }
    }

    public function getBookingByConductor_on_given_date($conductor, $date, $type){
        return $this->getBookingByConductor_on_given_date_byModel($conductor, $date, $type);
    }

    public function getBookingsForSelectedConductor($conductor_no){
        return $this->getBookingsForSelectedConductorFromModel($conductor_no);
    }

    public function getBookingsForSelectedConductor_FromGivenDate($conductor_no){
        return $this->getBookingsForSelectedConductorFromModel_FromGivenDate($conductor_no);
    }

    public function cancelBooking($booking_no)
    {
        $this->updateFlag_Booking_Cancel($booking_no);
    }

    public function getDistrictName($district_no){
        return $this->getDistrictName_model($district_no);
    }

    public function allocateConductorForBooking($booking_no, $conductor_no){
        $this->allocateConductorForBookingFromModel($booking_no, $conductor_no);
    }
}