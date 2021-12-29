<?php

require_once "dbh.class.php";
class Booking_Model extends Dbh
{
    private static  $instance;

    private function __construct()
    {

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Booking_Model();
        }
        return self::$instance;
    }


    public function getBookingDetails($booking_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM booking WHERE booking_no = $booking_no");
        $record = $stmt->fetch();
        return $record;
    }

    public function getBookingState($booking_no)
    {
        $stmt = $this->connect()->query("SELECT state FROM booking WHERE booking_no = $booking_no");
        $record = $stmt->fetch();
        return $record['state'];
    }

    public function upgradeState($booking_no)
    {
        $next_state = $this->getPassState($booking_no)+1;
        $sql = "UPDATE booking SET state=$next_state where service_no=$booking_no";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStateCanelled($booking_no)
    {
        $sql = "UPDATE booking SET state=3 where booking_no=$booking_no";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function getCurrentBookingsCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM Booking");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function addNewBooking($booking_no, $service_no, $start_date, $end_date, $pickup_district,
                                  $destination_district, $state, $booked_conductor_no){
        $sql2 = "INSERT INTO Pass(booking_no, service_no, start_date, end_date, pickup_district, destination_district, 
                 state, booked_conductor_no) VALUES (:booking_no, :service_no, :start_date, :end_date, :pickup_district,                                                    
                                                   :destination_district ,:stat, :booked_conductor_no)";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2 -> execute(array(
            ':booking_no' => $booking_no,
            ':service_no' => $service_no,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':pickup_district' => $pickup_district,
            ':destination_district' => $destination_district,
            ':stat' => $state,
            ':booked_conductor_no' => $booked_conductor_no));
        return $this->getCurrentBookingsCount();
    }


}

?>