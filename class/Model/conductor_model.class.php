<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";

class Conductor_Model extends Dbh{ // ## make the methods protected
    private $record;

    public function setRecord($conductor_id){
        $stmt1 = $this->connect()->query("SELECT * FROM users JOIN conductor ON Conductor.conductor_no = Users.account_no
            JOIN district ON Conductor.district_no = District.district_no WHERE Users.user_id = '{$conductor_id}' ");
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
        $sql = "SELECT * from conductor WHERE district_no=? and state = 0";
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
    
    protected function remove_conductor_FromModel($conductor_id)
    {
        $this->setRecord($conductor_id);
        $conductor_no = $this->record["conductor_no"];
        $sql = "UPDATE Conductor SET state=1 WHERE conductor_no = $conductor_no";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }
    protected function getAllLeavesDetails($conductor_no){
        $sql = "SELECT * FROM conductor_leave WHERE conductor_no = {$conductor_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchall();
        return $record;
    }

    private function getConductorCountOfAvailable(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM conductor WHERE state=0");
        $stmt->execute();
        $conductor_nos_count = $stmt->fetchColumn();
        return $conductor_nos_count;
    }

    private function getConductorNosLeavedToday(){
        $stmt = $this->connect()->prepare("SELECT count(*) from conductor_leave JOIN conductor ON conductor.conductor_no = conductor_leave.conductor_no WHERE conductor_leave.date=? and conductor.state = 0");
        $stmt->execute([Timer::getInstance()->get_current_date()]);
        $conductor_nos_leaved_today = $stmt->fetchColumn();
        if($conductor_nos_leaved_today==null){
            $conductor_nos_leaved_today = 0;
        }
        return $conductor_nos_leaved_today;
    }

    protected function getConductorCountTodayFromModel(){
        return $this->getConductorCountOfAvailable() - $this->getConductorNosLeavedToday();
    }

    protected function isConductorValid_model($conductor_id){
        $sql = "SELECT conductor_no FROM users JOIN conductor ON users.account_no = conductor.conductor_no WHERE users.account_type = 1 AND users.user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$conductor_id]);
        $record = $stmt->fetch();
        return $record;
    }

    protected function getConductorCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM conductor where state = 0");
        $stmt->execute();
        $count3 = $stmt->fetchColumn();
        return $count3;
    }
}