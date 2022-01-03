<?php


class Conductor extends User
{
    private $vehicle_no;
    private $district_no;
    private $state;
    private $district_name;

    public function __construct($conductor_id)
    {
        $this->setUserIdInUser($conductor_id);
        $conductor_model = new Conductor_Model();
        $conductor_model->setRecord($conductor_id);
        $row = $conductor_model->getRecord();

        if (!empty($row)) {
            $this->setAccountNoInUser($row['conductor_no']);
            $this->setFirstNameInUser($row['first_name']);
            $this->setLastNameInUser($row['last_name']);
            $this->setAddressInUser($row['address']);
            $this->setTelephoneInUser($row['telephone']);
            $this->vehicle_no = $row['vehicle_no'];
            $this->district_no = $row['district_no'];
            $this->setEmailInUser($row['email']);
            $this->state = $row['state'];
            $this->district_name = $row['name'];
        }
    }


    public function getfirst_name()
    {
        return $this->getFirstNameFromUser();
    }
    public function getlast_name()
    {
        return $this->getLastNameFromUser();
    }
    public function getaddress()
    {
        return $this->getAddressFromUser();
    }
    public function gettelephone()
    {
        return $this->getTelephoneFromUser();
    }
    public function getvehicle_no()
    {
        return $this->vehicle_no;
    }
    public function getdistrict_no()
    {
        return $this->district_no;
    }
    public function getemail()
    {
        return $this->getEmailFromUser();
    }
    public function getstate()
    {
        return $this->state;
    }
    public function getdistric_name()
    {
        return $this->district_name;
    }

    public function getconductor_no()
    {
        return $this->getAccountNoFromUser();
    }
}
