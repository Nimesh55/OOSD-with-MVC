<?php

include "dbh.class.php";

class Conductor extends Dbh
{

    private $conductor_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $vehicle_no;
    private $district_no;
    private $email;
    private $state;
    private $district_name;

    public function __construct($conductor_no)
    {
        $this->conductor_no = $conductor_no;
        $conductor_model = new Conductor_Model($conductor_no);
        $row = $conductor_model->getRecord();

        $this->passenger_no = $row['conductor_no'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->address = $row['address'];
        $this->telephone = $row['telephone'];
        $this->vehicle_no = $row['vehicle_no'];
        $this->district_no = $row['district_no'];
        $this->email = $row['email'];
        $this->state = $row['state'];
        $this->district_name = $row['name'];
    }

    public function getconductor_no(){return $this->conductor_no;}
    public function getfirst_name(){return $this->first_name;}
    public function getlast_name(){return $this->last_name;}
    public function getaddress(){return $this->address;}
    public function gettelephone(){return $this->telephone;}
    public function getvehicle_no(){return $this->vehicle_no;}
    public function getdistrict_no(){return $this->district_no;}
    public function getemail(){return $this->email;}
    public function getstate(){return $this->state;}
    public function getdistric_name(){return $this->district_name;}
}
