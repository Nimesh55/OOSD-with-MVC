<?php
// model in MVC

class Login extends Dbh{
    protected function getUser($uid, $password){
        // need to change ########
        $query = "SELECT password FROM users WHERE user_Id=?";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$uid])) {
            $stmt = null;
            header("location: ../test.php?error=stmtfail");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../test.php?error=NoSuchUser");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["password"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../test.php?error=wrongPwd");
            exit();
        }
        elseif ($checkPwd == true) {  
            // When Password is verified 
            $query2 = "SELECT * FROM users WHERE user_Id=?";
            $stmt = $this->connect()->prepare($query2);

            if (!$stmt->execute([$uid])) {
                $stmt = null;
                header("location: ../test.php?error=stmtfail");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../test.php?error=NoSuchUser");
                exit();
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $uidtest = $user["user_id"]; //for testing

            session_start();
            $_SESSION["user_Id"] = $user["user_id"];

            header("location: ../test.php?error=logged&user=$uidtest");// for testing
        }
    }
}