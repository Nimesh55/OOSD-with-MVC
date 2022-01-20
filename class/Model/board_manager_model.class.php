<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";
class Board_Manager_Model extends Dbh
{

    protected function getDistrictArray(){
        $query = "SELECT * FROM district";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $district_list;
    }

    protected function getDistrictName($district_no){
        $query = "SELECT name FROM district WHERE district_no={$district_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_name = $stmt->fetch(PDO::FETCH_ASSOC)['name'];
        return $district_name;
    }

    protected function getPendingBookingsCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM booking WHERE state=0");
        $stmt->execute();
        $count2 = $stmt->fetchColumn();
        return $count2;
    }

    protected function getActiveBookingsCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM booking WHERE state=1");
        $stmt->execute();
        $count1 = $stmt->fetchColumn();
        return $count1;
    }

    protected function getPendingPassesCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=1");
        $stmt->execute();
        $count2 = $stmt->fetchColumn();
        return $count2;
    }

    protected function getApprovedPassesCountFromModel(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=2");
        $stmt->execute();
        $count1 = $stmt->fetchColumn();
        return $count1;
    }

}