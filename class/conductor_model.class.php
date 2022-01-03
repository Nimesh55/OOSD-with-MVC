<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
require_once "dbh.class.php";

class Conductor_Model extends Dbh{ // ## make the methods protected
    private $record;

    public function setRecord($conductor_id){
        $stmt1 = $this->connect()->query("SELECT * FROM users JOIN conductor ON Conductor.conductor_no = Users.account_no
            JOIN district ON Conductor.district_no = District.district_no WHERE Users.user_id = $conductor_id ");
        $this->record = $stmt1->fetch();
    }

    public function getRecord(){
        return $this->record;
    }

    protected function getConductor_ByConductorNo($conductor_no)
    {
        $stmt2 = $this->connect()->query("SELECT user_id FROM users
            JOIN conductor ON Conductor.conductor_no = Users.account_no
            WHERE conductor.conductor_no = '{$conductor_no}' AND users.account_type = 1");
        $record2 = $stmt2->fetch();

        return $record2;
    }

    protected function getConductorsArrayByDistrictFromModel($district_no){
        $sql = "SELECT * from conductor WHERE district_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$district_no]);
        $record = $stmt->fetchAll();
        return $record;
    }

    protected function updateLeaveFromModel($conductor_no, $date){
        $sql = "INSERT INTO conductor_leave (conductor_no, date) VALUES ($conductor_no, '{$date}')";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function checkLeaveExist_FromModel($conductor_no, $date){
        $sql = "SELECT * FROM conductor_leave WHERE conductor_no=$conductor_no AND date='{$date}'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchAll();
        return $record;
    }

    protected function getConductorLeavesArrayFromModel($conductor_no){
        $sql = "SELECT * from conductor_leave WHERE conductor_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$conductor_no]);
        $record = $stmt->fetchAll();
        return $record;
    }

    protected function getDistrictNameFromModel($district_no){
        $sql = "SELECT name FROM district WHERE district_no = $district_no";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch();
        return $record['name'];
    }

    protected function changeDetails($details)
    {
        $stmt = $this->connect()->prepare("UPDATE Conductor SET first_name = :fn, last_name = :ln,
                     address = :addr, telephone = :tel, email = :em  WHERE conductor_no = :con_no");
        $stmt->execute(array(
            ':fn' => htmlentities($details['fname']),
            ':ln' => htmlentities($details['lname']),
            ':addr' => htmlentities($details['address']),
            ':em' => htmlentities($details['email']),
            ':tel' => htmlentities($details['telephone']),
            ':con_no' => htmlentities($details['conductor_no'])));
    }
    
}


?>