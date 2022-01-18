<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/dbh.class.php";
class Pass_Model extends Dbh
{
    private static  $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Pass_Model();
        }
        return self::$instance;
    }

    protected function getPassDetailsFromModel($pass_no)
    {
        $stmt = $this->connect()->query("SELECT * FROM pass WHERE pass_no = {$pass_no}");
        $record = $stmt->fetch();
        return $record;
    }

    protected function getPassStateFromModel($pass_no)
    {
        $stmt = $this->connect()->query("SELECT state FROM pass WHERE pass_no = {$pass_no}");
        $record = $stmt->fetch();
        return $record['state'];
    }

    protected function setPassStateAccept_one($pass_no)
    {
        $sql = "UPDATE pass SET state=1 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function setPassStateAccept_two($pass_no)
    {
        $sql = "UPDATE pass SET state=2 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function setStatePendingFromModel($pass_no)
    {
        $sql = "UPDATE pass SET state=0 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }


    protected function setStateExpiredFromModel($pass_no)
    {
        $sql = "UPDATE pass SET state=3 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function setStateDeclinedFromModel($pass_no)
    {
        $sql = "UPDATE pass SET state=4 where pass_no={$pass_no}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    }

    protected function getLastPassNo()
    {
        $stmt = $this->connect()->prepare("SELECT pass_no FROM Pass ORDER BY pass_no DESC");
        $stmt->execute();
        $last_no = $stmt->fetch();
        return $last_no['pass_no'];
    }

    protected function addNewPassFromModelWithFile($passenger_no, $service_no, $start_date, $end_date, $bus_route, $reason, $last_no)
    {

        $sql2 = "INSERT INTO Pass(passenger_no, service_no, start_date, end_date, state, bus_route, reason, file_no) VALUES (
                :passenger_no, :service_no, :start_date, :end_date, :stat, :bus_route, :reason, :file_no)";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2->execute(array(
            ':passenger_no' => $passenger_no,
            ':service_no' => $service_no,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':stat' => 0,
            ':bus_route' => $bus_route,
            ':reason' => $reason,
            ':file_no' => $last_no
        ));
        return $this->getLastPassNo();
    }

    protected function addNewPassFromModel($passenger_no, $service_no, $start_date, $end_date, $bus_route, $reason)
    {

        $sql2 = "INSERT INTO Pass(passenger_no, service_no, start_date, end_date, state, bus_route, reason) VALUES (
                :passenger_no, :service_no, :start_date, :end_date, :stat, :bus_route, :reason)";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2->execute(array(
            ':passenger_no' => $passenger_no,
            ':service_no' => $service_no,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':stat' => 0,
            ':bus_route' => $bus_route,
            ':reason' => $reason
        ));
        return $this->getLastPassNo();
    }



    private function getPendingPassesSearchQuery()
    {
        if (isset($_GET['search'])) {
            $input = $_GET['search'];

            $query = "SELECT * FROM users WHERE account_type=0 AND (user_id Like CONCAT( '%',?,'%'))  ORDER BY user_no";
            $stmt = $this->connect()->prepare($query);

            if ($stmt->execute([$input])) {
                $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $record_count = count($pending_passes);

                $query = "SELECT * FROM pass WHERE state=1 AND (";
                for ($i = 0; $i < $record_count; $i++) {
                    $record = $pending_passes[$i];
                    if ($i < $record_count - 1) {
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

    protected function getPendingPassesSearchArrayFromModel()
    {
        $query = $this->getPendingPassesSearchQuery();

        if (!$query) {
            $query = "SELECT * FROM pass WHERE state=1";
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pending_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $pending_passes;
    }

    private function getApprovedPassesSearchQuery()
    {
        if (isset($_GET['search'])) {
            $input = $_GET['search'];

            $query = "SELECT * FROM users WHERE account_type=0 AND (user_id Like CONCAT( '%',?,'%'))  ORDER BY user_no";
            $stmt = $this->connect()->prepare($query);

            if ($stmt->execute([$input])) {
                $pending_passes = $stmt->fetchAll();
                $record_count = count($pending_passes);
                $query = "SELECT * FROM pass WHERE state=2 AND (";
                for ($i = 0; $i < $record_count; $i++) {
                    $record = $pending_passes[$i];
                    if ($i < $record_count - 1) {
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

    protected function getApprovedPassesSearchArrayFromModel()
    {
        $query = $this->getApprovedPassesSearchQuery();

        if (!$query) {
            $query = "SELECT * FROM pass WHERE state=2";
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $approved_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $approved_passes;
    }

    protected function getPassesArrayForServiceFromModel($service_no)
    {
        $query = "SELECT * FROM pass WHERE  service_no={$service_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $service_passes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $service_passes;
    }

    protected function getPassby_passenger_id_model($passenger_id)
    {

        $query = "SELECT * FROM pass JOIN passenger ON pass.passenger_no = passenger.passenger_no JOIN users ON 
		    passenger.passenger_no=users.account_no JOIN Service ON service.service_no=pass.service_no WHERE users.user_id=$passenger_id AND pass.state=2";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $pass = $stmt->fetch();

        return $pass;
    }

    // Gets all the passes that are not expired or declined; used in Timer class
    protected function getAllPasses()
    {
        $query = "SELECT * FROM pass WHERE state = 0 OR state = 1 OR state = 2";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $passArray = $stmt->fetchAll();
        return $passArray;
    }

    // Get pass details array for Active Passes for a passenger by passenger_no
    protected function searchForActivePassFromModel($passenger_no)
    {
        $query = "SELECT * FROM pass WHERE (state = 0 OR state = 1 OR state = 2) and passenger_no = {$passenger_no}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $passArray = $stmt->fetch();
        return $passArray;
    }
}