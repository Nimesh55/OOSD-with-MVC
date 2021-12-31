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
    private static $instances = array();
    


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

    public function setUserId($user_id){$this->user_id=$user_id;}
    public function setPassengerNo($passenger_no){$this->passenger_no=$passenger_no;}
    public function setFirstName($first_name){$this->first_name=$first_name;}
    public function setLastName($last_name){$this->last_name=$last_name;}
    public function setAddress($address){$this->address=$address;}
    public function setTelephone($telephone){$this->telephone=$telephone;}
    public function setServiceNo($service_no){$this->service_no=$service_no;}
    public function setStaffId($staff_id){$this->staff_id=$staff_id;}
    public function setEmail($email){$this->email=$email;}
    public function setState($state){$this->state=$state;}

    private function __construct($user_id)
    {
      $this->user_id=$user_id;
    }

  public static function getInstance($user_id)
  {
    if(!array_key_exists($user_id, self::$instances)) {
      self::$instances[$user_id] = new self($user_id);
    }

    return self::$instances[$user_id];
  }

  }
