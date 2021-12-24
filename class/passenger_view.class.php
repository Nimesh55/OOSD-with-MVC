
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_View extends Passenger_Model{
    private $passenger;

    public function __construct($user_id){
      $this->passenger = Passenger::getPassengerInstance($user_id);
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
    public function getPassengerServiceNo(){
      return $this->passenger->getServiceNo();
    }
    public function getUserName(){
      $passenger_controller = new Passenger_Controller();
      return $passenger_controller->createUsername($this->passenger);
    }
    public function getServiceName($service_no){
      $service = new Service($service_no);
      return $service->getName();
    }
  }

 ?>
