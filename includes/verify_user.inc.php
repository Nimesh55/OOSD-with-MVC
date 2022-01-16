<?php
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";

$error = "";
if(isset($_POST['exit'])){
    header("location:../forget_password.php");
}
if(isset($_POST['verify'])){
    if(strcmp($_POST['code'],$_POST['verification_code'])==0){
        $error = "Verified";
        echo "equal";
        $_SESSION['user_Id'] = $_POST['user_id'];
        header("location:../password_reset.php");



    }else{
        $error = "failed";
        header("location:../forget_password.php?error={$error}");
    }
}