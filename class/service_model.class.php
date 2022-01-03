<?php

require_once "dbh.class.php";
class Service_Model extends Dbh
{
    private static  $instance;
    private function __construct()
    {
        
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Service_Model();
        }
        return self::$instance;
    }

    // returns an array of attributes of an Essential Service
    public function getServiceDetails($service_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM service WHERE service_no = $service_no");
        $record = $stmt->fetch();
        return $record;
    }

    //This method can be in tracker class
    public function addService($details)
    {
        $sql = "INSERT INTO service (id, name, state) VALUES (:id, :name, :stat)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array(
            ':id' => htmlentities($details['id']),
            ':name' => htmlentities($details['name']),
            ':stat' => htmlentities($details['state'])));
    }

    public function setStateNonEssential($service_no){
        $sql = "UPDATE service SET state=0 where id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    public function setStatePending($service_no){
        // echo $service_no;
        $sql = "UPDATE service SET state=1 where id=$service_no";
        echo $sql;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStateEssential($service_no){
        $sql = "UPDATE service SET state = 2 WHERE id= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    public function setStateRemoved($service_no){
        $sql = "UPDATE service SET state=3 where id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }
    public function getServiceNames(){
        $sql="SELECT * FROM service";
        $stmt = $this->connect()->query($sql);
        $services = $stmt->fetchAll();
        return $services;
    }

    public function getServiceName_FromModel($service_no)
    {
        $stmt = $this->connect()->query("SELECT name FROM service WHERE service_no = $service_no");
        $serviceName = $stmt->fetch();
        return $serviceName;
    }

    protected function setStateNonEssential_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE service SET state=0 where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    protected function setStatePending_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE service SET state=1 where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    protected function setStateEssential_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE service SET state = 2 WHERE service_no= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    protected function setStateRemoved_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE service SET state=3 where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }
}