<?php
// model in MVC

class Signup extends Dbh{
    protected function checkUser($uid){

        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$uid])) {
            $stmt = null;
            exit();
        }

        $resultCheck = false;
        if ($stmt->rowCount()>0) {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function addToUser($uid , $password, $firstname, $lastname, $address, $telephone, $email, $company_name, $company_Id, $vehicle_no, $district, $account_type){
        $query_error = false;
        if($account_type==0){
          //Add passenger to the passenger table
          $query1 = "INSERT INTO passenger (first_name, last_name, address, telephone, service_no, staff_id, email, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
          $stmt1 = $this->connect()->prepare($query1);
          if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, 0, 0, $email, 0))) {
            $query_error = true;
          }
          $stmt1 = null;
        }elseif ($account_type==1) {
            //Add passenger to the passenger table
            $query1 = "INSERT INTO conductor (first_name, last_name, address, telephone, vehicle_no, district_no, email, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt1 = $this->connect()->prepare($query1);
            if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, $vehicle_no, $district, $email, 0))) {
                $query_error = true;
            }
            $stmt1 = null;
        }else{
          // Add validation to the insertion service table
          //Add service to the service table
          $query0 = "INSERT INTO service (id, name, state) VALUES (?, ?, ?);";
          $stmt0 = $this->connect()->prepare($query0);

          if (!$stmt0->execute(array($company_Id, $company_name, 0))) {
              $stmt0 = null;
              header("location: ../test.php?error=query_error");
              exit();
          }
          $stmt0 = null;
          //Add executive to the executive table
          $service_no = $this->getLastServiceNo();
          $query1 = "INSERT INTO executive (first_name, last_name, address, telephone, service_no, email, state) VALUES (?, ?, ?, ?, ?, ?, ?);";
          $stmt1 = $this->connect()->prepare($query1);
          if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, $service_no, $email, 0))) {
            $query_error = true;
          }
          $stmt1 = null;
        }

        if ($query_error) {
            header("location: ../test.php?error=query_error");
            exit();
        }


        // $account_type = 0;      //for passengers
        $account_no = $this->getLastAccountNo($account_type);

        //Add user into the table
        $query2 = "INSERT INTO users (user_id, account_type, account_no, password) VALUES (?, ?, ?, ?);";
        $stmt2 = $this->connect()->prepare($query2);

        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt2->execute(array($uid, $account_type, $account_no, $hashedpwd))) {
            $stmt2 = null;
            exit();
        }
        $stmt2 = null;
    }

    private function getLastAccountNo($account_type){
      if($account_type==0){
        $account_name="passenger";
        $stmt = $this->connect()->query("SELECT * FROM passenger ORDER BY passenger_no DESC LIMIT 1");
      }elseif ($account_type==1) {
        $account_name="conductor";
        $stmt = $this->connect()->query("SELECT * FROM conductor ORDER BY conductor_no DESC LIMIT 1");
      }else{
        $account_name="executive";
        $stmt = $this->connect()->query("SELECT * FROM executive ORDER BY executive_no DESC LIMIT 1");
      }
      $row = $stmt->fetch();
      return $row[$account_name.'_no'];
    }

    private function getLastServiceNo(){
        $stmt = $this->connect()->query("SELECT * FROM service ORDER BY service_no DESC LIMIT 1");
        $row = $stmt->fetch();
        return $row['service_no'];
    }
}
