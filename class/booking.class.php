<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Booking{
    private $booking_no;
    private $service_no;
    private $reason;
    private $start_date;
    private $end_date;
    private $start_time;
    private $end_time;
    private $pickup_district;
    private $pickup_location;
    private $destination_district;
    private $destination_location;
    private $passenger_count;
    private $state;
    private $booked_conductor_no;
    private $flag;
    private $replacement_conductor_no;

    function __construct(){

    }

    public function setValues($booking_no, $service_no, $reason, $start_date, $end_date, $start_time, $end_time,
                              $pickup_district, $pickup_location, $destination_district, $destination_location,
                              $passenger_count, $state, $booked_conductor_no, $flag, $replacement_conductor_no){
        $this->booking_no = $booking_no;
        $this->service_no = $service_no;
        $this->reason = $reason;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->pickup_district = $pickup_district;
        $this->pickup_location = $pickup_location;
        $this->destination_district = $destination_district;
        $this->destination_location = $destination_location;
        $this->passenger_count = $passenger_count;
        $this->state = $state;
        $this->booked_conductor_no = $booked_conductor_no;
        $this->flag = $flag;
        $this->replacement_conductor_no = $replacement_conductor_no;
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

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    public function getPickupLocation()
    {
        return $this->pickup_location;
    }

    public function getDestinationLocation()
    {
        return $this->destination_location;
    }

    public function getFlag()
    {
        return $this->flag;
    }

    public function getReplacementConductorNo()
    {
        return $this->replacement_conductor_no;
    }






}