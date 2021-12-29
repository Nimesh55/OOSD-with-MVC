<?php

require_once "dbh.class.php";
class Pass_Model extends Dbh
{
    private static  $instance;

    private function __construct()
    {

    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Pass_Model();
        }
        return self::$instance;
    }

    public function getPassDetails($pass_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM pass WHERE pass_no = {$pass_no}");
        $record = $stmt->fetch();
        return $record;
    }

    public function getPassState($pass_no)
    {
        $stmt = $this->connect()->query("SELECT state FROM pass WHERE pass_no = {$pass_no}");
        $record = $stmt->fetch();
        return $record['state'];
    }

    public function upgradeState($pass_no)
    {
        $next_state = $this->getPassState($pass_no)+1;
        $sql = "UPDATE pass SET state={$next_state} where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStatePending($pass_no)
    {
        $sql = "UPDATE pass SET state=0 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }


    public function setStateExpired($pass_no)
    {
        $sql = "UPDATE pass SET state=3 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function setStateDeclined($pass_no)
    {
        $sql = "UPDATE pass SET state=4 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    public function getCurrentPassesCount(){
        $stmt = $this->connect()->prepare("SELECT count(*) FROM Pass");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }

    public function addNewPass($passenger_no, $service_no, $start_date, $end_date, $state, $bus_route, $reason){

        $sql2 = "INSERT INTO Pass(passenger_no, service_no, start_date, end_date, state, bus_route, reason) VALUES (
                :passenger_no, :service_no, :start_date, :end_date, :stat, :bus_route, :reason)";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2 -> execute(array(
            ':passenger_no' => $passenger_no,
            ':service_no' => $service_no,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':stat' => $state,
            ':bus_route' => $bus_route,
            ':reason' => $reason));
        return $this->getCurrentPassesCount();
    }



    private function getPendingPassesSearchQuery(){
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
                        $query .= " passenger_no={$record['account_no']} OR";
                    } else {
                        $query .= " passenger_no={$record['account_no']})";
                    }
                }
                return $query;
            }
        }
        return null;
    }

    public function getPendingPassesSearchArray(){
        $query = $this->getPendingPassesSearchQuery();

        if(!$query){
            $query = "SELECT * FROM pass WHERE state=1";
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pending_passes;
    }

    private function getApprovedPassesSearchQuery(){
        if(isset($_GET['search'])){
            // Handle sql injection in following query when add get value in search
            $query = "SELECT * FROM users WHERE account_type=0 AND (user_id Like '%{$_GET['search']}%')  ORDER BY user_no";
            $stmt = $this->connect()->prepare($query);

            if($stmt->execute()){
                $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $record_count = count($pending_passes);

                $query = "SELECT * FROM pass WHERE state=2 AND (";
                for($i=0; $i<$record_count; $i++){
                    $record = $pending_passes[$i];
                    if($i < $record_count-1){
                        $query .= " passenger_no={$record['account_no']} OR";
                    } else {
                        $query .= " passenger_no={$record['account_no']})";
                    }
                }
                return $query;
            }
        }
        return null;
    }

    public function getApprovedPassesSearchArray(){
        $query = $this->getApprovedPassesSearchQuery();

        if(!$query){
            $query = "SELECT * FROM pass WHERE state=2";
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pending_passes;
    }

    public function getPassesArrayForService($service_no){
        $query = "SELECT * FROM pass WHERE (state=0 OR state=1) AND service_no={$service_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $service_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $service_passes;
    }
}

?>