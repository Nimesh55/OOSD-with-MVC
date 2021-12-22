<?php

require_once "dbh.class.php";
class Service_Model extends Dbh
{
    private $record;
    function __construct($service_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM service WHERE service_no = $service_no");
        $this->record = $stmt->fetch();
    }
    public function getRecord()
    {
        return $this->record;
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

    public function setStatePending(){
        $sql = "UPDATE service SET state=1 where service_no={$this->getRecord()['service_no']}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStateEssential(){
        $sql = "UPDATE service SET state=2 where service_no={$this->getRecord()['service_no']}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStateRemoved(){
        $sql = "UPDATE service SET state=3 where service_no={$this->getRecord()['service_no']}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

}
?>
