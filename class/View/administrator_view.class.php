
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Administrator_View extends Administrator_Model{
    private $adminobj;
    private $adminctrl;

    public function __construct(){
        $this->adminctrl = new Administrator_Controller;
        $this->adminobj = $this->adminctrl->setUpDetails();
    }
    public function getDetails()
    {
      $details=array(
                "uid"=> $this->adminobj->getUid(),
                "pending"=> $this->adminobj->getnumPendingCompany(),
                "approved"=> $this->adminobj->getnumApprovedService(),
                "issued"=> $this->adminobj->getnumIssuedPasses());

      return $details;
    }

    public function getPendingRows(){
      return $this->getPendingEssentialServices();
    }

    public function getApprovedRows(){
      return $this->getApprovedEssentialServices();
    }

    public function fetchDetails($service_no){
      $row = $this->adminctrl->formatForView($service_no);
      $details=array(
        "service_no"=> $row['service_no'],
        "id"=> $row['id'],
        "name"=> $row['name'],
        "state"=> $row['state'],
        "file_no"=> $row['file_no']);
      return $details;
    }
    public function getEmailSettingsDetails(){
        return $this->getNotificationConfigData();
    }
  }