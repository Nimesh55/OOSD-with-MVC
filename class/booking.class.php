<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Booking{
    private $booking_no;
    private $service_no;
    private $reason;
    private $start_date;
    private $end_date;
    private $pickup_district;
    private $destination_district;
    private $passenger_count;
    private $state;
    private $booked_conductor_no;

    function __construct(){

    }

    public function setValues($booking_no, $service_no, $reason, $start_date, $end_date, $pickup_district,
                              $destination_district, $passenger_count, $state, $booked_conductor_no){
        $this->booking_no = $booking_no;
        $this->service_no = $service_no;
        $this->reason = $reason;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->pickup_district = $pickup_district;
        $this->destination_district = $destination_district;
        $this->passenger_count = $passenger_count;
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

    public function getReason()
    {
        return $this->reason;
    }

    public function getPassengerCount()
    {
        return $this->passenger_count;
    }





}