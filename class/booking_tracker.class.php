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

    //returns a booking object
    public function getBooking($booking_no){
        $booking = new Booking();
        $details = Booking_Controller::getInstance()->getBookingDetails($booking_no);
        $booking->setValues($booking_no, $details["service_no"], $details["reason"], $details["start_date"],
            $details["end_date"], $details["start_time"], $details["end_time"], $details["pickup_district"],
            $details["pickup_location"], $details["destination_district"], $details["destination_location"],
            $details["passenger_count"], $details["state"],  $details["booked_conductor_no"], $details['flag'],
            $details['replacement_conductor_no']);
        return $booking;
    }

    //create a new pass
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

        foreach ($bookings as $booking){
            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
        }
        return $bookings_arr;
    }


    public function getBookingsArrayForService($service_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsArrayForService($service_no);

        foreach ($bookings as $booking){
            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
        }
        return $bookings_arr;
    }

    public function getBookingsForDistrict($district_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsForDistrict($district_no);

        foreach ($bookings as $booking){
            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
        }
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

        foreach ($bookings as $booking){
            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
        }
        return $bookings_arr;
    }

    public function getBookingsForConductor_FromGivenDate($conductor_no){
        $bookings_arr = array();
        $bookings = Booking_Controller::getInstance()->getBookingsForSelectedConductor_FromGivenDate($conductor_no);

        foreach ($bookings as $booking){
            array_push($bookings_arr, $this->getBooking($booking['booking_no']));
        }
        return $bookings_arr;
    }

    public function cancelBooking($booking_no)
    {
        Booking_Controller::getInstance()->cancelBooking($booking_no);
        return;
    }

    public function update($curDate){
        $change=0;
        $bookingArray = $this->getBookingsArray();
        foreach ($bookingArray as $booking) {
            $bookingEnd = $booking->getEndDate();
            if ($curDate > $bookingEnd && $booking->getState()!=2) {
                $this->setbookingStateExpired($booking->getBookingNo());
                $change++;
            }
        }
        return $change;
    }
}


