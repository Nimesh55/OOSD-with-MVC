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


    protected function getBookingDetailsFromModel($booking_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM booking WHERE booking_no = {$booking_no}");
        $record = $stmt->fetch();
        return $record;
    }

    protected function getBookingStateFromModel($booking_no)
    {
        $stmt = $this->connect()->query("SELECT state FROM booking WHERE booking_no = {$booking_no}");
        $record = $stmt->fetch();
        return $record['state'];
    }

    protected function setStateApprovedFromModel($booking_no)
    {
        $sql = "UPDATE booking SET state=1 where booking_no={$booking_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function setStateExpireedFromModel($booking_no)
    {
        $sql = "UPDATE booking SET state=2 where booking_no={$booking_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function setStateCanelledFromModel($booking_no)
    {
        $sql = "UPDATE booking SET state=3 where booking_no={$booking_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function getCurrentBookingsCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM Booking");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    protected function addNewBookingFromModel($booking_no, $service_no, $start_date, $end_date, $pickup_district,
                                  $destination_district, $state, $booked_conductor_no){
        $sql = "INSERT INTO Pass(booking_no, service_no, start_date, end_date, pickup_district, destination_district, 
                 state, booked_conductor_no) VALUES (:booking_no, :service_no, :start_date, :end_date, :pickup_district,                                                    
                                                   :destination_district ,:stat, :booked_conductor_no)";
        $stmt = $this->connect()->prepare($sql);
        $stmt -> execute(array(
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

    protected function getBookingsArrayFromModel(){
        $stmt = $this->connect()->prepare("SELECT * FROM Booking WHERE (state=0 OR state=1)");
        $stmt->execute();
        $booking_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $booking_array;
    }

    protected function getBookingsArrayForServiceFromModel($service_no){
        $query = "SELECT * FROM booking WHERE (state=0 OR state=1) AND service_no={$service_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $service_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $service_bookings;
    }


}

?>