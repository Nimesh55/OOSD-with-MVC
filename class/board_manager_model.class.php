<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";
class Board_Manager_Model extends Dbh
{
    public function getPendingPassesCnt(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=1");
        $stmt->execute();
        $count2 = $stmt->fetchColumn();
        return $count2;
    }

    public function getApprovedPassesCount(){
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

    // Load first name and last name of passenger from given passenger_no
    // This must be done using Passenger object
    public function getPassengerName($passenger_no){

        $name = null;
        $query = "SELECT first_name,last_name FROM passenger WHERE passenger_no={$passenger_no}";

        $stmt = $this->connect()->prepare($query);

        if ($stmt->execute()) {
            $passengerDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $passengerDetails['first_name'] . " " . $passengerDetails['last_name'];
        }
        return $name;
    }

    public function getDistrictArray(){
        $query = "SELECT * FROM district";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $district_list;
    }

    //Remove this after passenger class created
    public function getPassengerEmail($passenger_no){

        $email = null;
        $query = "SELECT email FROM passenger WHERE passenger_no={$passenger_no}";

        $stmt = $this->connect()->prepare($query);

        if ($stmt->execute()) {
            $passengerDetails = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $passengerDetails['email'];
        }
        return $email;
    }

    protected function getDistrictName($district_no){
        $query = "SELECT name FROM district WHERE district_no={$district_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_name = $stmt->fetch(PDO::FETCH_ASSOC)['name'];
        return $district_name;
    }


}