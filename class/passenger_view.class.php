
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Passenger_View extends Passenger_Model{
    private $passenger;

    public function __construct($passenger_no){
      $this->passenger = new Passenger($passenger_no);
    }
    public function getDetails()
    {
      $details=array(
                "first_name"=> $this->passenger->getfirst_name(),
                "passenger_no"=> $this->passenger->getpassenger_no(),
                "first_name"=> $this->passenger->getfirst_name(),
                "last_name"=> $this->passenger->getlast_name(),
                "address"=> $this->passenger->getaddress(),
                "telephone"=> $this->passenger->gettelephone(),
                "service_no"=> $this->passenger->getservice_no(),
                "staff_id"=> $this->passenger->getstaff_id(),
                "email"=> $this->passenger->getemail(),
                "state"=> $this->passenger->getstate());
      return $details;

    }
  }

 ?>
