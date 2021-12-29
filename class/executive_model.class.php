<?php

require_once "dbh.class.php";
class Executive_Model extends Dbh
{
    public function getRecord($user_id)
    {
        $sql = "SELECT * FROM users JOIN executive ON Executive.executive_no = Users.account_no WHERE Users.user_id = $user_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
    }

    protected function changeDetails($details)
    {
        $stmt = $this->connect()->prepare("UPDATE Executive SET first_name = :fn, last_name = :ln,
                     address = :addr, telephone = :tel, email = :em  WHERE executive_no = :exe_no");
        $stmt->execute(array(
            ':fn' => htmlentities($details['fname']),
            ':ln' => htmlentities($details['lname']),
            ':addr' => htmlentities($details['address']),
            ':em' => htmlentities($details['email']),
            ':tel' => htmlentities($details['telephone']),
            ':exe_no' => htmlentities($details['executive_no'])));
    }

    protected function getServiceName($service_no){
        $stmt = $this->connect()->prepare("SELECT * FROM service where service_no = ?");
        $stmt->execute(array($service_no));
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        return $service['name'];
    }

    protected function getPassengerCountFromService($service_no){
        $sql = "SELECT COUNT(*) FROM Passenger where service_no=? AND state>1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($service_no));
        $count = $stmt->fetchColumn();
        return $count;

    }

    protected function getRequestedPassesCount($service_no){
        $sql = "SELECT COUNT(*) FROM Pass where service_no=? AND state='0' ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($service_no));
        $count = $stmt->fetchColumn();
        return $count;
    }

    protected function getApprovedPassesCount($service_no){
        $sql = "SELECT COUNT(*) FROM Pass where service_no=? AND state='1' ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array($service_no));
        $count = $stmt->fetchColumn();
        return $count;
    }

<<<<<<< Updated upstream
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
?>
