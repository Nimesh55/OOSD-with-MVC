<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
require_once "dbh.class.php";

class Conductor_Model extends Dbh{
    private $record;

    public function setRecord($conductor_no){
        $stmt1 = $this->connect()->query("SELECT * FROM users JOIN conductor ON Conductor.conductor_no = Users.account_no
            JOIN district ON Conductor.district_no = District.district_no WHERE Users.user_id = $conductor_no ");
        $this->record = $stmt1->fetch();
    }

    public function getRecord(){
        return $this->record;
    }

    
}


?>