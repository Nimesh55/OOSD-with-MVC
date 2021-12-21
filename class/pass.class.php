<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/OOSD-with-MVC/includes/autoloader.inc.php";

class Pass extends Dbh{
    private $pass_no;
    private $passenger_no;
    private $service_no;
    private $start_date;
    private $end_date;
    private $state;
    private $bus_route;
    private $reason;

    function __construct($pass_no, $passenger_no, $service_no, $start_date, $end_date, $state, $bus_route, $reason){
        $this->pass_no = $pass_no;
        $this->passenger_no = $passenger_no;
        $this->service_no = $service_no;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->state = $state;
        $this->bus_route = $bus_route;
        $this->reason = $reason;

    }

    protected function getPassengerNo(){
        return $this->passenger_no;
    }

    protected function getServiceNo(){
        return $this->service_no;
    }

    protected function getStartDate(){
        return $this->start_date;
    }

    public function getPassNo(){
        return $this->pass_no;
    }

    public function getEndDate(){
        return $this->end_date;
    }

    public function getState(){
        return $this->state;
    }

    public function getBusRoute(){
        return $this->bus_route;
    }

    public function getReason(){
        return $this->reason;
    }



}