
<?php
  require_once "../includes/autoloader.inc.php";
  class PassengerView extends Passenger{
    private $passenger;

    public function __construct($passenger_no){
      $this->passenger = new Passenger($passenger_no);
    }
    public function getDetails()
    {
      $details=array($this->passenger->getfirst_name(),
                $this->passenger->getpassenger_no(),
                $this->passenger->getfirst_name(),
                $this->passenger->getlast_name(),
                $this->passenger->getaddress(),
                $this->passenger->gettelephone(),
                $this->passenger->getservice_no(),
                $this->passenger->getstaff_id(),
                $this->passenger->getemail(),
                $this->passenger->getstate());
      echo $this->passenger->getfirst_name();
      return $details;

    }
  }

  // $p = new PassengerView(2);
  // print_r($p->getDetails());
 ?>
