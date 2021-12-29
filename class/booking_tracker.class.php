<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
// Tracker Class Singleton
class Booking_Tracker extends Tracker
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

    //returns a Pass object with details
    public function getBooking($booking_no){
        $booking = new Booking();
        $details = Booking_Model::getInstance()->getBookingDetails($booking_no);
        $booking->setValues($booking_no, $details["service_no"], $details["start_date"],
            $details["end_date"], $details["pickup_district"], $details["destination_district"],
            $details["state"],  $details["booked_conductor_no"]);
        return $pass;
    }

}


