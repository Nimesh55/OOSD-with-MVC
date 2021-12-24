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
            ':fn' => htmlentities($details['first_name']),
            ':ln' => htmlentities($details['last_name']),
            ':addr' => htmlentities($details['address']),
            ':em' => htmlentities($details['email']),
            ':tel' => htmlentities($details['telephone']),
            ':exe_no' => htmlentities($details['executive_no'])));
    }

    protected function getServiceName($service_no){
        $stmt = $this->connect()->prepare("SELECT * FROM service where service_no = ?");
        $stmt->execute(array($service_no));
//        $stmt->execute();
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
}
?>
