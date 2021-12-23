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
//    public function getpassenger_no(){return $this->passenger_no;}
//    public function getfirst_name(){return $this->first_name;}
//    public function getlast_name(){return $this->last_name;}
//    public function getaddress(){return $this->address;}
//    public function gettelephone(){return $this->telephone;}
//    public function getservice_no(){return $this->service_no;}
//    public function getstaff_id(){return $this->staff_id;}
//    public function getemail(){return $this->email;}
//    public function getstate(){return $this->state;}



  }




 ?>
