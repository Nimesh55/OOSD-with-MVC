<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class Conductor extends User
{
    private $vehicle_no; // try to make a class
    private $vehicle;
    private $district_no;
    private $state;
    private $district_name;
    private static $instances = array();

    private function __construct($conductor_id)
    {
        parent::setUserId($conductor_id);
        $conductor_model = new Conductor_Model();
        $conductor_model->setRecord($conductor_id);
        $row = $conductor_model->getRecord();

        if (!empty($row)) {
            parent::setAccountNo($row['conductor_no']);
            parent::setFirstName($row['first_name']);
            parent::setLastName($row['last_name']);
            parent::setAddress($row['address']);
            parent::setTelephone($row['telephone']);
            //$this->vehicle_no = $row['vehicle_no'];
            $this->district_no = $row['district_no'];
            parent::setEmail($row['email']);
            $this->state = $row['state'];
            $this->district_name = $row['name'];
            $this->vehicle = new Vehicle($row['vehicle_no'], "24");
        }
    }


    public function getVehicleNo()
    {
        // return $this->vehicle_no;
        return $this->vehicle->get_Vehicle_no();
    }
    public function getDistrictNo()
    {
        return $this->district_no;
    }

    public function getState()
    {
        return $this->state;
    }
    public function getDistricName()
    {
        return $this->district_name;
    }

    public function getConductorNo()
    {
        return parent::getAccountNo();
    }

    public static function getInstance($user_id)
    {
        if(!array_key_exists($user_id, self::$instances)) {
            self::$instances[$user_id] = new self($user_id);
        }
        return self::$instances[$user_id];
    }
}
