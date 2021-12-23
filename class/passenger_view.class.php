
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_View extends Passenger_Model{
    private $passenger;

    public function __construct($passenger_no){
      $this->passenger = Passenger::getPassengerInstance($passenger_no);
    }
    public function getDetails()
    {
      $details=array(
          "passenger_no"=> $this->passenger->getPassengerNo(),
          "first_name"=> $this->passenger->getFirstName(),
          "last_name"=> $this->passenger->getLastName(),
          "address"=> $this->passenger->getAddress(),
          "telephone"=> $this->passenger->getTelephone(),
          "service_no"=> $this->passenger->getServiceNo(),
          "staff_id"=> $this->passenger->getStaffId(),
          "email"=> $this->passenger->getEmail(),
          "state"=> $this->passenger->getState());
      return $details;

    }

    public function getPassState(){
      return $this->passenger->getState();
    }
    public function getUserName($passenger_no){
      $passenger_controller = new Passenger_Controller($passenger_no);
      return $passenger_controller->createUsername($this->passenger);

    }
  }

 ?>
