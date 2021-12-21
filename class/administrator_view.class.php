
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
  class Administrator_view extends Administrator_model{
    private $adminobj;
    private $adminctrl;

    public function __construct(){
        $this->adminctrl = new Administrator_controller;
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
  }