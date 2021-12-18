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

    protected function addToUser($uid , $password, $firstname, $lastname, $address, $telephone, $email){

        //Add passenger to the passenger table
        $query1 = "INSERT INTO passenger (first_name, last_name, address, telephone, service_no, staff_id, email, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt1 = $this->connect()->prepare($query1);

        if (!$stmt1->execute(array($firstname, $lastname, $address, $telephone, 0, 0, $email, 0))) {
            $stmt1 = null;
            header("location: ../test.php?error=query_error");
            exit();
        }

        //Get last passenger no(added one) from passenger table
        $stmt = $this->connect()->query("SELECT * FROM passenger ORDER BY passenger_no DESC LIMIT 1");
        $row = $stmt->fetch();

        $account_type = 0;      //for passengers
        $account_no = $row['passenger_no'];

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
}