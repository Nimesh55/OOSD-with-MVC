<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/OOSD-with-MVC/includes/autoloader.inc.php";

class Service{
    private $service_no;
    private $id;
    private $name;
    private $state;

    function __construct($service_no){

        $this->service_no=$service_no;
        $service_model = new Service_Model($service_no);
        $row = $service_model->getRecord();

        $this->service_no = $row['service_no'];
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->state = $row['state'];
    }

    public function getServiceNo()
    {
        return $this->service_no;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getState()
    {
        return $this->state;
    }



}