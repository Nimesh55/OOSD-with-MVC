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

    protected function addToUser($uid , $password){
        $val1 = 0;
        $val2 = 0;
        $query = "INSERT INTO users (user_id, account_type, account_no, password) VALUES (?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($query);

        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);



        
        if (!$stmt->execute(array($uid, $val1, $val2, $hashedpwd))) {
            $stmt = null;
            exit();
        }

        $stmt = null;

    }
}