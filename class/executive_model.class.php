<?php
require_once "dbh.class.php";
class Executive_Model extends Dbh
{
    protected function getRecord($user_id)
    {
        $sql = "SELECT * FROM users JOIN executive ON Executive.executive_no = Users.account_no WHERE Users.user_id = '{$user_id}'";
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
        $stmt->execute(array('{$service_no}'));
        $service = $stmt->fetch();
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
    
    // protected function getPasses($service_no){ // remove this properly
    //     $stmt = $this->connect()->prepare("SELECT * FROM pass where service_no = ? AND state<3");
    //     $stmt->execute(array($service_no));
    //     $passes_in_service = $stmt->fetchAll();
    //     return $passes_in_service;
    // }

    protected function getPassengerNumbers_inService($service_no){
        $stmt = $this->connect()->prepare("SELECT passenger_no FROM passenger where service_no = ? AND (state =1 OR state = 2) ORDER BY state"); //only in pending or approved state. Adjust the order as neccessary
        $stmt->execute(array($service_no));
        $passengers_in_service = $stmt->fetchAll();
        return $passengers_in_service;
    }

    protected function getDistrictName($district_no){
        $query = "SELECT name FROM district WHERE district_no={$district_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_name = $stmt->fetch(PDO::FETCH_ASSOC)['name'];
        return $district_name;
    }

    public function getDistrictArray(){
        $query = "SELECT * FROM district";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $district_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $district_list;
    }

    protected function setStateUnregistered_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE executive SET state=0 where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    protected function setStatePending_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE executive SET state=1 where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    protected function setStateRegistered_using_ServiceNo_FromModel($service_no){
        $sql = "UPDATE executive SET state = 2 WHERE service_no= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$service_no]);
    }

    private function getFilesLastFileNo(){
        $stmt = $this->connect()->prepare("SELECT file_no FROM files ORDER BY file_no DESC ");
        $stmt->execute();
        $last_no = $stmt->fetch();
        return $last_no['file_no'];
    }

    private function uploadFileToDB(){
        $stmt = $this->connect()->prepare("INSERT INTO `files` (`file_name`, `file_data`) VALUES (?,?)");
        $stmt->execute([$_FILES["file"]["name"], file_get_contents($_FILES["file"]["tmp_name"])]);
        unset($_FILES['file']);
        return $this->getFilesLastFileNo();
    }

    protected function setStatePending_using_ServiceNo_FromModel_WithFile($service_no){

        $file_no = $this->uploadFileToDB();

        $sql = "UPDATE executive SET state=1,file_no=? where service_no=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$file_no, $service_no]);
    }
    protected function checkPassword($user_id,$password){
//        print_r($_SESSION);
        $query = "SELECT password FROM users WHERE user_Id=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$user_id]);
        $pwdHashed = $stmt->fetch();
        return password_verify($password, $pwdHashed["password"]);
    }
}
