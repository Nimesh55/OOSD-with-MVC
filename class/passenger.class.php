<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger extends User
  {
    private $service_no;
    private $staff_id;
    private $state;
    private $file_no;
    private static $instances = array();

    //getters
    public function getPassengerNo(){return parent::getAccountNo();}
    public function getServiceNo(){return $this->service_no;}
    public function getStaffId(){return $this->staff_id;}
    public function getState(){return $this->state;}
    public function getFileNo(){return $this->file_no;}


    public function setPassengerNo($passenger_no){parent::setAccountNo($passenger_no);}
    public function setServiceNo($service_no){$this->service_no=$service_no;}
    public function setStaffId($staff_id){$this->staff_id=$staff_id;}
    public function setState($state){$this->state=$state;}
    public function setFileNo($file_no){$this->file_no = $file_no;}

    private function __construct($user_id)
    {
      parent::setUserId($user_id);
    }

  public static function getInstance($user_id)
  {
    if(!array_key_exists($user_id, self::$instances)) {
      self::$instances[$user_id] = new self($user_id);
    }

    return self::$instances[$user_id];
  }

  }
