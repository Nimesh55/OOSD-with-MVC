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

    function __construct(){

    }

    public function setValues($booking_no, $service_no, $start_date, $end_date, $pickup_district,
                              $destination_district, $state, $booked_conductor_no){
        $this->booking_no = $booking_no;
        $this->service_no = $service_no;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->pickup_district = $pickup_district;
        $this->destination_district = $destination_district;
        $this->state = $state;
        $this->booked_conductor_no = $booked_conductor_no;
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