<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

class EssentialService{
    private $service_no;
    private $id;
    private $name;
    private $state;
    private $file_no;

    function __construct($service_no){

        $this->service_no=$service_no;
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

    public function setValues($service_no, $id, $name, $state, $file_no){
        $this->service_no = $service_no;
        $this->id = $id;
        $this->name = $name;
        $this->state = $state;
        $this->file_no = $file_no;
    }

    public function getFileNo()
    {
        return $this->file_no;
    }


}