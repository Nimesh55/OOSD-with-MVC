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
}