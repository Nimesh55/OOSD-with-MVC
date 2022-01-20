<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";
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
        $sql = "SELECT * FROM booking WHERE booking_no = $booking_no";
        $stmt = $this->connect()->query($sql);
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

    protected function setStateCompletedFromModel($booking_no)
    {
        $sql = "UPDATE booking SET state=4 where booking_no={$booking_no}";
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
        $query = "SELECT * FROM booking WHERE service_no={$service_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $service_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $service_bookings;
    }

    protected function getBookingsArrayForPickupFromModel($district_no){
        $query = "SELECT * FROM booking WHERE pickup_district={$district_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pickup_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pickup_bookings;
    }



    // make sure to give date and conductor as varchar
    // type means we are checking booked conductor or replcement conductor
    protected function getBookingByConductor_on_given_date_byModel($conductor_no, $date, $type)
    {
        if ($type == 'booked') {
            $query = "SELECT booking_no FROM conductor JOIN booking ON conductor.conductor_no=booking.booked_conductor_no 
                WHERE booking.start_date<='{$date}' AND booking.end_date>='{$date}' AND conductor.conductor_no=$conductor_no AND booking.flag=0";
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
        $query = "SELECT * FROM booking WHERE booked_conductor_no={$conductor_no} AND flag=0";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $conductor_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $conductor_bookings;
    }

    protected function updateFlag_Booking_Cancel($booking_no)
    {
        $query1 = "UPDATE booking SET flag=1 where booking_no=$booking_no";
        $stmt1 = $this->connect()->prepare($query1);
        $stmt1->execute();

        $query2 = "UPDATE booking SET state=0 where booking_no=$booking_no";
        $stmt2 = $this->connect()->prepare($query2);
        $stmt2->execute();
    }

    protected function getBookingsForSelectedConductorFromModel_FromGivenDate($conductor_no){
        $date = date('Y-m-d');
        $query = "SELECT * FROM booking WHERE booked_conductor_no={$conductor_no} AND state=1 AND flag=0 AND end_date>'{$date}'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $conductor_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $conductor_bookings;
    }

    protected function getDistrictName_model($district_no){
        $query = "SELECT * FROM district WHERE district_no=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$district_no]);
        $result = $stmt->fetch();
        return $result['name'];
    }

    protected function allocateConductorForBookingFromModel($booking_no, $conductor_no){
        $sql = "UPDATE booking SET booked_conductor_no={$conductor_no}, state=1, flag=0 where booking_no={$booking_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function removeBooking($booking_no){
        $query2 = "UPDATE booking SET state=4 where booking_no=$booking_no";
        $stmt2 = $this->connect()->prepare($query2);
        $stmt2->execute();
    }
}
?>