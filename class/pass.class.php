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

    function __construct($pass_no){

        $this->pass_no=$pass_no;
        $pass_model = new Pass_Model($pass_no);
        $row = $pass_model->getRecord();

        $this->pass_no = $row['pass_no'];
        $this->passenger_no = $row['passenger_no'];
        $this->service_no = $row['service_no'];
        $this->start_date = $row['start_date'];
        $this->end_date = $row['end_date'];
        $this->state = $row['state'];
        $this->bus_route = $row['bus_route'];
        $this->reason = $row['reason'];
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