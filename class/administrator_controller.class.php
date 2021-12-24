<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Administrator_controller extends Administrator_model
  {
    private $transportBoardAdministrator;

  public function setUpDetails()
  {
    $this->transportBoardAdministrator = new TransportBoardAdministrator();
    $this->transportBoardAdministrator->setValues($_SESSION['user_Id'], $this->getNumberOfPendingCompanies(), $this->getNumberofServicesApproved(), $this->getNumberofIssuedPasses());

    return $this->transportBoardAdministrator;
  }

  public function formatForView($service_no){
    $tracker = EssentialServiceTracker::getInstance();
    $ServiceObj = $tracker->createService($service_no);
    $state = 'x';
    if ($ServiceObj->getState() == '0') {
      $state = 'Non-Essential';
    }
    else if ($ServiceObj->getState() == '1') {
      $state = 'Pending';
    }
    else if ($ServiceObj->getState() == '2') {
      $state = 'Essential';
    }
    else if ($ServiceObj->getState() == '3') {
      $state = 'Removed';
    }
    $details=array(
      "id"=> $ServiceObj->getId(),
      "name"=> $ServiceObj->getName(),
      "state"=> $state);
    return $details;
  }

  
}