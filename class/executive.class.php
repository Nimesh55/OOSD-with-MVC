<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive extends User
{
    private $service_no;
    private $state;

    function __construct()
    {

    }

    public function setValues($uid, $executive_no, $first_name, $last_name, $address, $telephone, $service_no, $email, $state){
        $this->setUserIdInUser($uid);
        $this->setAccountNoInUser($executive_no);
        $this->setFirstNameInUser($first_name);
        $this->setLastNameInUser($last_name);
        $this->setAddressInUser($address);
        $this->setTelephoneInUser($telephone);
        $this->service_no = $service_no;
        $this->setEmailInUser($email);
        $this->state=$state;
    }

    public function getExecutiveNo()
    {
        return $this->getAccountNoFromUser();
    }

    public function getFirstName()
    {
        return $this->getFirstNameFromUser();
    }

    public function getLastName()
    {
        return $this->getLastNameFromUser();
    }

    public function getAddress()
    {
        return $this->getAddressFromUser();
    }

    public function getTelephone()
    {
        return $this->getTelephoneFromUser();
    }

    public function getServiceNo()
    {
        return $this->service_no;
    }

    public function getEmail()
    {
        return $this->getEmailFromUser();
    }

    public function getState()
    {
        return $this->state;
    }

}

?>
