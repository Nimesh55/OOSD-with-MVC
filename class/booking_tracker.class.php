<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/class/observer.interface.php";
// Tracker Class Singleton
class Booking_Tracker extends Tracker implements Observer
{
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Booking_Tracker();
        }
        return self::$instance;
    }

    //returns a booking object with booking_no
    public function getBooking($booking_no){
        $booking = new Booking();
        $details = Booking_Controller::getInstance()->getBookingDetails($booking_no);
        $booking->setValues($booking_no, $details["service_no"], $details["reason"], $details["start_date"],
            $details["end_date"], $details["start_time"], $details["end_time"], $details["pickup_district"],
            $details["pickup_location"], $details["destination_district"], $details["destination_location"],
            $details["passenger_count"], $details["state"],  $details["booked_conductor_no"], $details['flag']);
        return $booking;
    }

    //create a booking and return a booking object
    public function createBooking($details){
        $booking_no = Booking_Controller::getInstance()->addNewBooking(
            $details['service_no'],
            $details['reason'],
            $details['start_date'],
            $details['end_date'],
            $details['start_time'],
            $details['end_time'],
            $details['pickup_district'],
            $details['pickup_location'],
            $details['destination_district'],
            $details['destination_location'],
            $details['passenger_count']);
        $booking = $this->getBooking($booking_no);
        return $booking;
    }

    public function setbookingStateExpired($booking_no){
        Booking_Controller::getInstance()->setStateExpired($booking_no);
    }

    public function getBookingsArray(){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsArray();

        $my_iterator = new My_Iterator($bookings);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($bookings_arr,$this->getBooking($my_iterator->current()['booking_no']));
        }

//        foreach ($bookings as $booking){
//            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
//        }
        return $bookings_arr;
    }


    public function getBookingsArrayForService($service_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsArrayForService($service_no);

        $my_iterator = new My_Iterator($bookings);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($bookings_arr,$this->getBooking($my_iterator->current()['booking_no']));
        }

//        foreach ($bookings as $booking){
//            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
//        }

        return $bookings_arr;
    }

    public function getBookingsForDistrict($district_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsForDistrict($district_no);

        $my_iterator = new My_Iterator($bookings);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($bookings_arr,$this->getBooking($my_iterator->current()['booking_no']));
        }

//        foreach ($bookings as $booking){
//            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
//        }

        return $bookings_arr;
    }

    // can be extended to return the Booking and conductor details
    public function checkBooking($conductor, $date, $type)
    {
        $result = Booking_Controller::getInstance()->getBookingByConductor_on_given_date($conductor, $date, $type);
        if(!empty($result)){
            //Booking Found
            return true;
        }
        else {
            // Booking not found
            return false;
        }
        
    }

    public function getBookingsForConductor($conductor_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsForSelectedConductor($conductor_no);

        $my_iterator = new My_Iterator($bookings);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($bookings_arr,$this->getBooking($my_iterator->current()['booking_no']));
        }

//        foreach ($bookings as $booking){
//            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
//        }

        return $bookings_arr;
    }

    public function getBookingsForConductor_FromGivenDate($conductor_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsForSelectedConductor_FromGivenDate($conductor_no);

        $my_iterator = new My_Iterator($bookings);
        for(;$my_iterator->valid();$my_iterator->next()){
            array_push($bookings_arr,$this->getBooking($my_iterator->current()['booking_no']));
        }

//        foreach ($bookings as $booking){
//            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
//        }

        return $bookings_arr;
    }

    public function cancelBooking($booking_no)
    {
        Booking_Controller::getInstance()->cancelBooking($booking_no);

        $executive = $this->getExecutiveFromBookingNumber($booking_no);
        $booking = $this->getBooking($booking_no);
        $conductor = Conductor_Tracker::getInstance()->getConductorbyNumber($booking->getBookedConductorNo());
        $param = [9, $booking->getBookingNo(), $conductor->getVehicleNo()];
        //Cancel Booking Notifiction
        Notification_handler::setupNotification($executive->getEmail(),$executive->getTelephone(),$param);
    }

    public function cancelBookingBulk($bookingArray)
    {
        foreach($bookingArray as $booking){
            Booking_Controller::getInstance()->cancelBooking_byBookingNo($booking->getBookingNo());
        }
    }

    public function cancelBookingByExecutive($booking_no){
        Booking_Controller::getInstance()->setStateCompleted($booking_no);
    }

    // Used for Notification parameter Processing
    public function getExecutiveFromBookingNumber($booking_no){
        $service_no = $this->getBooking($booking_no)->getServiceNo();
        return EssentialServiceTracker::getInstance()->getExecutiveByServiceNo($service_no);
    }

    public function getServiceFromBookingNumber($booking_no){
        $service_no = $this->getBooking($booking_no)->getServiceNo();
        return EssentialServiceTracker::getInstance()->createService($service_no);
    }

    public function getDistrictName($district_no){
        return Booking_Controller::getInstance()->getDistrictName($district_no);
    }

    public function update($curDate){
        $change=0;
        $bookingArray = $this->getBookingsArray();

        $my_iterator = new My_Iterator($bookingArray);
        for(;$my_iterator->valid();$my_iterator->next()){
            $booking = $my_iterator->current();
            $bookingEnd = $booking->getEndDate();
            if ($curDate > $bookingEnd && $booking->getState()!=2) {
                $this->setbookingStateExpired($booking->getBookingNo());
                $change++;
            }
        }

//        foreach ($bookingArray as $booking) {
//            $bookingEnd = $booking->getEndDate();
//            if ($curDate > $bookingEnd && $booking->getState()!=2) {
//                $this->setbookingStateExpired($booking->getBookingNo());
//                $change++;
//            }
//        }
        return $change;
    }

    public function allocateConductorForBooking($booking_no, $conductor_no){
        Booking_Controller::getInstance()->allocateConductorForBooking($booking_no, $conductor_no);
    }
}


