<?php

require_once "dbh.class.php";
class Booking_Model extends Dbh
{
    private static  $instance;

    private function __construct()
    {

    }

    protected static function getInstance(){
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

    protected function addNewBookingFromModel($service_no, $reason, $start_date, $end_date, $start_time,
                                              $end_time, $pickup_district, $pickup_location, $destination_district,
                                              $destination_location, $passenger_count){
        $sql = "INSERT INTO Booking(service_no, reason, start_date, end_date, start_time, end_time, 
                    pickup_district, pickup_location, destination_district, destination_location, passenger_count)
                     VALUES (:service_no, :reason, :start_date, :end_date, :start_time, :end_time,
                    :pickup_district, :pickup_location, :destination_district , :destination_location, :passenger_count)";
        $stmt = $this->connect()->prepare($sql);
        $stmt -> execute(array(
            ':service_no' => $service_no,
            ':reason' => $reason,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            'start_time' => $start_time,
            ':end_time' => $end_time,
            ':pickup_district' => $pickup_district,
            ':pickup_location' => $pickup_location,
            ':destination_district' => $destination_district,
            ':destination_location' =>$destination_location,
            ':passenger_count' => $passenger_count));
        return self::getCurrentBookingsCountFromModel();
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