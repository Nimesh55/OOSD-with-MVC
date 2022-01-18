<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/class/Model/dbh.class.php";
class Password_Changer_Model extends Dbh{

    protected function getPassword(){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute(array($_SESSION['user_Id']));
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        return $service['password'];
    }

    protected function changePassword($new_password){
        $stmt = $this->connect()->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        if($stmt->execute(array($new_password,$_SESSION['user_Id']))){
            return true;
        }else{
            return false;
        }
    }
}