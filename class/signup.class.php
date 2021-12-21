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

        $resultCheck = null;
        if ($stmt->rowCount()>0) {
            $resultCheck = true;
        }
        else{
            $resultCheck = false;
        }
        return $resultCheck;
    }

    protected function addToUser($uid , $password, $firstname, $lastname, $address, $telephone, $email, $company_name, $company_Id, $account_type){

        $query_error = false;
        if($account_type==0){
          //Add passenger to the passenger table
          $query1 = "INSERT INTO passenger (first_name, last_name, address, telephone, service_no, staff_id, email, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
          $stmt1 = $this->connect()->prepare($query1);
          if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, 0, 0, $email, 0))) {
            $query_error = true;
          }
        }elseif ($account_type==0) {
          // Query for insert conductor to the table
        }else{
          // Add validation to the insertion service table
          //Add service to the service table
          $query0 = "INSERT INTO service (id, name, state) VALUES (?, ?, ?);";
          $stmt0 = $this->connect()->prepare($query0);

          if (!$stmt0->execute(array($company_Id, $company_name, $address, 0))) {
              $stmt0 = null;
              header("location: ../test.php?error=query_error");
              exit();
          }
          //Add executive to the passenger table
          $query1 = "INSERT INTO executive (first_name, last_name, address, telephone, service_no, email, state) VALUES (?, ?, ?, ?, ?, ?, ?);";
          $stmt1 = $this->connect()->prepare($query1);
          if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, 0, 0, $email, 0))) {
            $query_error = true;
          }
        }

        $stmt1 = $this->connect()->prepare($query1);

        if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, 0, 0, $email, 0))) {
            $stmt1 = null;
            header("location: ../test.php?error=query_error");
            exit();
        }

        //Get last passenger no(added one) from passenger table
        // $stmt = $this->connect()->query("SELECT * FROM passenger ORDER BY passenger_no DESC LIMIT 1");
        // $row = $stmt->fetch();

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
        $account_name="condcutor";
        $stmt = $this->connect()->query("SELECT * FROM conductor ORDER BY conductor_no DESC LIMIT 1");
      }else{
        $account_name="executive";
        $stmt = $this->connect()->query("SELECT * FROM executive ORDER BY executive_no DESC LIMIT 1");
      }
      $row = $stmt->fetch();
      return $row[$account_name.'_no'];
    }
}
