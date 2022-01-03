<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger extends User
  {
    private $service_no;
    private $staff_id;
    private $state;
    private static $instances = array();

    //getters
    public function getUserId(){return $this->getUserIdFromUser();}
    public function getPassengerNo(){return $this->getAccountNoFromUser();}
    public function getFirstName(){return $this->getFirstNameFromUser();}
    public function getLastName(){return $this->getLastNameFromUser();}
    public function getAddress(){return $this->getAddressFromUser();}
    public function getTelephone(){return $this->getTelephoneFromUser();}
    public function getServiceNo(){return $this->service_no;}
    public function getStaffId(){return $this->staff_id;}
    public function getEmail(){return $this->getEmailFromUser();}
    public function getState(){return $this->state;}

    public function setUserId($user_id){$this->setUserIdInUser($user_id);}
    public function setPassengerNo($passenger_no){$this->setAccountNoInUser($passenger_no);}
    public function setFirstName($first_name){$this->setFirstNameInUser($first_name);}
    public function setLastName($last_name){$this->setLastNameInUser($last_name);}
    public function setAddress($address){$this->setAddressInUser($address);}
    public function setTelephone($telephone){$this->setTelephoneInUser($telephone);}
    public function setServiceNo($service_no){$this->service_no=$service_no;}
    public function setStaffId($staff_id){$this->staff_id=$staff_id;}
    public function setEmail($email){$this->setEmailInUser($email);}
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
