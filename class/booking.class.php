<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/OOSD-with-MVC/includes/autoloader.inc.php";

class Booking{
    private $booking_no;
    private $service_no;
    private $start_date;
    private $end_date;
    private $pickup_district;
    private $destination_district;
    private $state;
    private $booked_conductor_no;

    function __construct($booking_no){

        $this->booking_no=$booking_no;
        $booking_model = new Booking_Model($booking_no);
        $row = $booking_model->getRecord();

        $this->service_no = $row['service_no'];
        $this->start_date = $row['start_date'];
        $this->end_date = $row['end_date'];
        $this->pickup_district = $row['pickup_district'];
        $this->destination_district = $row['destination_district'];
        $this->state = $row['state'];
        $this->booked_conductor_no = $row['booked_conductor_no'];
    }

    public function getBookingNo()
    {
        return $this->booking_no;
    }

    public function getServiceNo()
    {
        return $this->service_no;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function getPickupDistrict()
    {
        return $this->pickup_district;
    }

    public function getDestinationDistrict()
    {
        return $this->destination_district;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getBookedConductorNo()
    {
        return $this->booked_conductor_no;
    }

}