<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive extends User
{
    private $service_no;
    private $state;


    public function setValues($uid, $executive_no, $first_name, $last_name, $address, $telephone, $service_no, $email, $state){
        parent::setUserId($uid);
        parent::setAccountNo($executive_no);
        parent::setFirstName($first_name);
        parent::setLastName($last_name);
        parent::setAddress($address);
        parent::setTelephone($telephone);
        $this->service_no = $service_no;
        parent::setEmail($email);
        $this->state=$state;
    }

    public function getExecutiveNo()
    {
        return parent::getAccountNo();
    }

    public function getServiceNo()
    {
        return $this->service_no;
    }

    public function getState()
    {
        return $this->state;
    }

}

?>
