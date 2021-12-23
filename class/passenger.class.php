<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger
  {
    private $passenger_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $service_no;
    private $staff_id;
    private $email;
    private static $passengerInstance;

    /**
     * @return mixed
     */
    public static function getPassengerInstance($passenger_no)
    {
      if(isset(self::$passengerInstance) && self::$passengerInstance->$passenger_no==$passenger_no){
        return self::$passengerInstance;
      }
      return new Passenger($passenger_no);
    }

    /**
     * @return mixed
     */
    public function getPassengerNo()
    {
      return $this->passenger_no;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
      return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
      return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
      return $this->address;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
      return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getServiceNo()
    {
      return $this->service_no;
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
      return $this->staff_id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
      return $this->email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
      return $this->state;
    }
    private $state;

    /**
     * @return mixed
     */

    private function __construct($passenger_no)
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





  }




 ?>
