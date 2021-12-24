<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
class Executive
{
    private $uid;
    private $executive_no;
    private $first_name;
    private $last_name;
    private $address;
    private $telephone;
    private $service_no;
    private $email;
    private $state;

    function __construct()
    {

    }

    public function setValues($uid, $executive_no, $first_name, $last_name, $address, $telephone, $service_no, $email, $state){
        $this->uid = $uid;
        $this->executive_no = $executive_no;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->service_no = $service_no;
        $this->email=$email;
        $this->state=$state;
    }

    public function getExecutiveNo()
    {
        return $this->executive_no;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getServiceNo()
    {
        return $this->service_no;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getState()
    {
        return $this->state;
    }

}

?>
