<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";
class Board_Manager_Model extends Dbh
{
    protected function getApprovedPaasesCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=2");
        $stmt->execute();
        $count1 = $stmt->fetchColumn();
        return $count1;
    }

    protected function getPendingPaasesCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM pass WHERE state=0 OR state=1");
        $stmt->execute();
        $count2 = $stmt->fetchColumn();
        return $count2;
    }

    protected function getConductorCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM conductor");
        $stmt->execute();
        $count3 = $stmt->fetchColumn();
        return $count3;
    }

    protected function getPendingPassesQuery(){
        if(isset($_GET['search'])){
            // Handle sql injection in following query when add get value in search
            $query = "SELECT * FROM users WHERE account_type=0 AND (user_id Like '%{$_GET['search']}%')  ORDER BY user_no";
            $stmt = $this->connect()->prepare($query);

            if($stmt->execute()){
                $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $record_count = count($pending_passes);

                $query = "SELECT * FROM pass WHERE state=1 AND (";
                for($i=0; $i<$record_count; $i++){
                    $record = $pending_passes[$i];
                    if($i < $record_count-1){
                        $query .= " passenger_no={$record['user_no']} OR";
                    } else {
                        $query .= " passenger_no={$record['user_no']})";
                    }
                }
                return $query;
            }
        }
        return null;
    }

    protected function getPendingPasses(){
        $query = $this->getPendingPassesQuery();

        if(!$query){
            $query = "SELECT * FROM pass WHERE state=1";
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pending_passes = $stmt->fetchAll();

        return $pending_passes;
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


}