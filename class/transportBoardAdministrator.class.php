<?php
class TransportBoardAdministrator extends Transport_Board_User{
    private $numPendingCompany;
    private $numApprovedService;
    private $numIssuedPasses;

    public function setValues($uid, $pending, $approved, $issued){
        parent::setUid($uid);
        $this->numPendingCompany = $pending;
        $this->numApprovedService = $approved;
        $this->numIssuedPasses = $issued;
    }

    public function getnumPendingCompany(){return $this->numPendingCompany;}
    public function getnumApprovedService(){return $this->numApprovedService;}
    public function getnumIssuedPasses(){return $this->numIssuedPasses;}

}