
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_View extends Passenger_Model{
    private $passenger;

    public function __construct($user_id){
      $passenger_tracker = Passenger_Tracker::getInstance();
      $this->passenger = $passenger_tracker->getPassenger($user_id);
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
          "file_no"=> $this->passenger->getFileNo(),
          "state"=> $this->passenger->getState());
      return $details;

    }
    public function getPassengerNo(){
      return $this->passenger->getPassengerNo();
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
      $essential_service_tracker = EssentialServiceTracker::getInstance();
      $service = $essential_service_tracker->createService($service_no);
      return $service->getName();
    }
    public function getPassengerStaffId(){
      return $this->passenger->getStaffId();
    }
    public function getPassengerUserId($passenger_no)
    {
      return $this->getUserId($passenger_no);
    }

    public function getPassengerFileDetails(){
      $details = File_Controller::getInstance()->getFileDetails($this->passenger->getFileNo());
      return $details;
    }

    public function getPassFileDetails(){
      $pass = Pass_Tracker::getInstance()->getActivePassForPassenger($this->passenger->getPassengerNo());
      $details = null;
      if($pass!=null){
        $details = File_Controller::getInstance()->getFileDetails($pass->getFileNo());
      }
      return $details;
    }

  }

 ?>
