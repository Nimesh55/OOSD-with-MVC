<?php
class TransportBoardAdministrator{
    private $uid;
    private $numPendingCompany;
    private $numApprovedService;
    private $numIssuedPasses;

    public function __construct(){

    }

    public function setValues($uid, $pending, $approved, $issued){
        $this->uid = $uid;
        $this->numPendingCompany = $pending;
        $this->numApprovedService = $approved;
        $this->numIssuedPasses = $issued;
    }

    public function getUid(){return $this->uid;}
    public function getnumPendingCompany(){return $this->numPendingCompany;}
    public function getnumApprovedService(){return $this->numApprovedService;}
    public function getnumIssuedPasses(){return $this->numIssuedPasses;}

}