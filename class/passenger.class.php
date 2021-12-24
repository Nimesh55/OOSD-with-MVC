<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger
  {
    private $user_id;
    private $passenger_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $service_no;
    private $staff_id;
    private $email;
    private $state;


    //getters
    public function getUserId(){return $this->user_id;}
    public function getPassengerNo(){return $this->passenger_no;}
    public function getFirstName(){return $this->first_name;}
    public function getLastName(){return $this->last_name;}
    public function getAddress(){return $this->address;}
    public function getTelephone(){return $this->telephone;}
    public function getServiceNo(){return $this->service_no;}
    public function getStaffId(){return $this->staff_id;}
    public function getEmail(){return $this->email;}
    public function getState(){return $this->state;}

    private function __construct($user_id)
    {
      $this->user_id=$user_id;
      $passenger_model = new Passenger_Model();
      $passenger_model->setRecord($user_id);
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
      $_SESSION['instance']=$this;

    }

    public static function getInstance($user_id)
    {
      if(!isset($_SESSION['instance'])){
        $_SESSION['instance'] = new Passenger($user_id);
      }
      return $_SESSION['instance'];
    }









  }




 ?>
