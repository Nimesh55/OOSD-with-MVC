
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Executive_View extends Executive_Model{
    private $executivectrl;
    private $executiveobj;

    public function __construct(){
        $this->executivectrl = new Executive_Controller();
        $this->executiveobj = $this->executivectrl->setUpDetails();

    }

    public function getHomeDetails()
    {

        $details=array(
            "name"=> $this->executiveobj->getFirstName()." ".$this->executiveobj->getLastName(),
            "passenger_count" => $this->getPassengerCountFromService($this->executiveobj->getServiceNo()),
            "requested_passes_count" => $this->getRequestedPassesCount($this->executiveobj->getServiceNo()),
            "approved_passes_count" => $this->getApprovedPassesCount($this->executiveobj->getServiceNo()),
            "service_name"=>$this->getServiceName($this->executiveobj->getServiceNo()));
        return $details;

    }
}

?>
