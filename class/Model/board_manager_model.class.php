<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";
class Board_Manager_Model extends Dbh
{
    protected function getPendingPassesCnt(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=1");
        $stmt->execute();
        $count2 = $stmt->fetchColumn();
        return $count2;
    }

    protected function getApprovedPassesCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=2");
        $stmt->execute();
        $count1 = $stmt->fetchColumn();
        return $count1;
    }

    protected function getConductorCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM conductor");
        $stmt->execute();
        $count3 = $stmt->fetchColumn();
        return $count3;
    }

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

    protected function allocateConductorForBookingFromModel($booking_no, $conductor_no){
        $sql = "UPDATE booking SET booked_conductor_no={$conductor_no}, state=1, flag=0 where booking_no={$booking_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }


}