<?php

session_start();
class Change_Password_Controller extends Password_Changer_Model{

    public function updatePassword($current_password, $new_password, $password_repeat, $forget=0){

        if($forget==0 && (empty($current_password) || empty($new_password) || empty($password_repeat))){
            $_SESSION['error'] = "Fill all fields and try again";
            header("location: ../change_password.php");
            exit();
        }

        if (strcmp($new_password, $password_repeat) != 0) {
            $_SESSION['error'] = "New password and re-entered password don't match. Try again.";
            header("location: ../change_password.php");
            exit();
        }

       if(!$this->checkPasswordStrength($new_password)){
           $_SESSION['error'] = "Enter strong password";
           if ($forget==0){
               header("location: ../change_password.php");
           }else{
               header("location: ../password_reset.php");
           }
           exit();
       }

        $hashed_pwd = $this->getPassword();
        if((password_verify($current_password,$hashed_pwd))||$forget==1){
            $new_hashedpwd = password_hash($new_password, PASSWORD_DEFAULT);

            if(!$this->changePassword($new_hashedpwd)){
                $_SESSION['error'] = "Error occured in the system";
                if($forget==0){
                    header("location: ../change_password.php");
                }else{
                    header("location: ../forget_password_reset.php");
                }
                exit();
            }
            if($forget==1){
                header("location: ../login.php?error=success");
                exit();
            }

            $type = $_SESSION['account_type'];
            if($type<=2){
                header("location: ../edit_profile.php");
            }elseif ($type ==3){
                header("location: ../board_manager_home.php");
            }elseif ($type == 4){
                header("location: ../administrator_home.php");
            }

        }else{
            $_SESSION['error'] = "Password is invalid.";
            header("location: ../change_password.php");
        }
    }

    private function checkPasswordStrength($password){
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);    
        if(strlen($password) >= 8 && $number && $uppercase && $lowercase && $specialChars) {
            return true;
        } else {
            return false;
        }
    }

    public function returnPage(){
        $type = $_SESSION['account_type'];
        if ($type <= 2) {
            header("location: ../edit_profile.php");
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