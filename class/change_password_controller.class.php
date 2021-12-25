<?php

class Change_Password_Controller extends Password_Changer{

    public function updatePassword($current_password, $new_password, $password_repeat, $type){

        if(empty($current_password) || empty($new_password) || empty($password_repeat)){
            $_SESSION['error'] = "Fill all fields and try again";
            header("location: ../change_password.php?account_type=$type");
            exit();
        }

        if (strcmp($new_password, $password_repeat) != 0) {
            $_SESSION['error'] = "New password and reentered password don't match. Try again.";
            header("location: ../change_password.php?account_type=$type");
            exit();
        }

//        This is for check strength of the new entered password. Uncomment after finalized

//        if(!$this->checkPasswordStrength($new_password)){
//            $_SESSION['error'] = "Enter_strong_password";
//            header("location: ../change_password.php?account_type=$type&error=Enter_strong_password");
//            exit();
//        }

        $hashed_pwd = $this->getPassword();
        if(password_verify($current_password,$hashed_pwd)){
            $new_hashedpwd = password_hash($new_password, PASSWORD_DEFAULT);

            if(!$this->changePassword($new_hashedpwd)){
                $_SESSION['error'] = "Error occured in the system";
                header("location: ../change_password.php");
                exit();
            }

            if($type<=2){
                header("location: ../edit_profile.php?account_type=$type");
            }elseif ($type ==3){
                header("location: ../board_manager_home.php");
            }elseif ($type == 4){
                header("location: ../administrator_home.php");
            }

        }else{
            $_SESSION['error'] = "Entered password is invalid.";
            header("location: ../change_password.php?account_type=$type");
        }
    }

    private function checkPasswordStrength($password){
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) >= 8 && $number && $uppercase && $lowercase && $specialChars) {
            return true;
        } else {
            return false;
        }
    }

    public function returnPage($type){
        if ($type <= 2) {
            header("location: ../edit_profile.php?account_type=<?= $type ?>");
            exit();
        }else if ($type == 3) {
            header("location: ../board_manager_home.php");
            exit();
        }
        else if ($type == 4) {
            header("location: ../administrator_home.php");
            exit();
        }
    }


}