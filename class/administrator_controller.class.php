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
      "state"=> $state,
      "file_no"=> $ServiceObj->getFileNo()
    );
    return $details;
  }
  public function getAdministratorEmailSettings(){
      return $this->getEmailSettings();
  }
  public function addAdministratorNewEmailSettings($email,$password,$port){
    $error = '';
    $this->is_email($email);
    if (empty($password)){
       $error = "*Password should not be empty!!!";
    }
    if(!is_numeric($port)){
        $error = "*Port number should be a number!";
    }

    if(empty($error)){
        $this->addNewEmailSettings($email,$password,$port);
    }
    return $error;

  }

  public function editAdministratorEmailSettings($email,$password,$port){
      $error = '';
      $this->is_email($email);
      if (empty($password)){
          $error = "*Password should not be empty!!!";
      }
      if(!is_numeric($port)){
          $error = "*Port number should be a number!";
      }

      if(empty($error)){
          $this->editEmailSettings($email,$password,$port);
      }
      return $error;


  }


  private function is_email($email){
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          return '* Please insert valid email!!! ';
      }
  }

  
}