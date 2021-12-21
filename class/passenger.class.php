<?php


  include "dbh.class.php";
  // include "../includes/autoloader.inc.php";
  class Passenger extends Dbh
  {
    private $passenger_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $service_no;
    private $staff_id;
    private $email;
    private $state;

    function __construct($passenger_no)
    {
      $this->passenger_no=$passenger_no;
      $passenger_model = new Passenger_Model($passenger_no);
      $row = $passenger_model->getRecord();

      $this->passenger_no=$row['passenger_no'];
      $this->first_name=$row['first_name'];
      $this->last_name=$row['last_name'];
      $this->address=$row['address'];
      $this->telephone=$row['telephone'];
      $this->service_no=$row['service_no'];
      $this->staff_id=$row['staff_id'];
      $this->email=$row['email'];
      $this->state=$row['state'];


    }
    public function getpassenger_no(){return $this->passenger_no;}
    public function getfirst_name(){return $this->first_name;}
    public function getlast_name(){return $this->last_name;}
    public function getaddress(){return $this->address;}
    public function gettelephone(){return $this->telephone;}
    public function getservice_no(){return $this->service_no;}
    public function getstaff_id(){return $this->staff_id;}
    public function getemail(){return $this->email;}
    public function getstate(){return $this->state;}



  }




 ?>
