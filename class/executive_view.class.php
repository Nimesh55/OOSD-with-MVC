
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Executive_View extends Executive_Model{
    private $executivectrl;
    private $executiveobj;
    private $pass_tracker;

    public function __construct(){
        $this->executivectrl = new Executive_Controller();
        $this->executiveobj = $this->executivectrl->setUpDetails();
        $this->pass_tracker = Pass_Tracker::getInstance();

    }

    public function getHomeDetails()
    {

        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "passenger_count" => $this->getPassengerCountFromService($this->executiveobj->getServiceNo()),
            "requested_passes_count" => $this->getRequestedPassesCount($this->executiveobj->getServiceNo()),
            "approved_passes_count" => $this->getApprovedPassesCount($this->executiveobj->getServiceNo()),
            "service_name"=>$this->getServiceName($this->executiveobj->getServiceNo()),
            "service_number"=>$this->executiveobj->getServiceNo());
        return $details;

    }

    public function getPassDetailsDetails(){
        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "service_passes" => $this->pass_tracker->getPassesArrayForService($this->executiveobj->getServiceNo()),
            "service_passes_count" => count($this->pass_tracker->getPassesArrayForService($this->executiveobj->getServiceNo())));
        return $details;
    }

    public function getPassDetailsViewDetails($pass_no){
        $pass = $this->pass_tracker->getPass($pass_no);
        $status = $this->executivectrl->getPassStatus($pass->getState());
        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "passenger_no" => $pass->getPassengerNo(),
            "route" => $pass->getBusRoute(),
            "time_slot" => $pass->getStartDate()." to ".$pass->getEndDate(),
            "reason" => $pass->getReason(),
            "status" => $status);
        return $details;
    }

    public function getDetails()
    {
        $details=array(
            "first_name"=> $this->executiveobj->getFirstName(),
            "last_name"=> $this->executiveobj->getLastName(),
            "address"=> $this->executiveobj->getAddress(),
            "email"=> $this->executiveobj->getEmail(),
            "telephone"=> $this->executiveobj->getTelephone());
        return $details;

    }

    public function getPassesDetails($service_no)
    { // fix this with proper details
        $details= $this->getPasses($service_no);
        return $details;

    }
}