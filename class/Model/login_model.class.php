<?php
// model in MVC
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";
class Login_Model extends Dbh{
    protected function getUser($uid, $password){
        $query = "SELECT password FROM users WHERE user_Id=?";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$uid])) {
            $stmt = null;
            header("location: ../login.php?error=stmtfail");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login.php?error=NoSuchUser");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["password"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../login.php?error=wrongPwd"); //return error -1 or something like that
            exit();
        }
        elseif ($checkPwd == true) {
            // When Password is verified
            $query2 = "SELECT * FROM users WHERE user_Id=?";
            $stmt = $this->connect()->prepare($query2);

            if (!$stmt->execute([$uid])) {
                $stmt = null;
                header("location: ../login.php?error=stmtfail");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../login.php?error=NoSuchUser");
                exit();
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userType = $user["account_type"];

            session_start();
            $_SESSION["user_Id"] = $user["user_id"];
            $_SESSION["account_type"] = $user["account_type"];

            if($userType<3){
                $_SESSION["account_no"] = $user["account_no"];
            }
            else {
                $_SESSION["account_no"] = "x"; //for testing
            }
            //Direct to Homepage of user type
            return $userType;
        }
        return -1;
    }

    protected function getUserConductorState($uid){
        $query = "SELECT state FROM users JOIN conductor ON users.account_no = conductor.conductor_no WHERE user_Id=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$uid]);
        $result = $stmt->fetch();
        return $result['state'];
    }
}
