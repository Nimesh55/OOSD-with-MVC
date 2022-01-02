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

    protected function setStateExpiredFromModel($booking_no)
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

    private function getCurrentBookingsCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT booking_no FROM Booking ORDER BY booking_no DESC ");
        $stmt->execute();
        $last_no = $stmt->fetch();
        return $last_no['booking_no'];
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
        return $this->getCurrentBookingsCountFromModel();
    }

    protected function getBookingsArrayFromModel(){
        $stmt = $this->connect()->prepare("SELECT * FROM Booking");
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

    // make sure to give date and conductor as varchar
    // type means we are checking booked conductor or replcement conductor
    protected function getBookingByConductor_on_given_date_byModel($conductor_no, $date, $type)
    {
        if ($type == 'booked') {
            $query = "SELECT booking_no FROM conductor JOIN booking ON conductor.conductor_no=booking.booked_conductor_no 
                WHERE booking.start_date<='{$date}' AND booking.end_date>='{$date}' AND conductor.conductor_no=$conductor_no";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $booking_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $booking_details;
        }else {
            $query = "SELECT booking_no FROM conductor JOIN booking ON conductor.conductor_no=booking.replacement_conductor_no 
                WHERE booking.start_date<='{$date}' AND booking.end_date>='{$date}' AND conductor.conductor_no=$conductor_no";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            $booking_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $booking_details;
        }
        
    }

    protected function getBookingsForSelectedConductorFromModel($conductor_no){
        $query = "SELECT * FROM booking WHERE booked_conductor_no={$conductor_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $conductor_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $conductor_bookings;
    }

}

?>