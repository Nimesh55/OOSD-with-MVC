<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}

$errors_str = "";

if($_GET['account_type']==0){
    $account_name = "passenger";
    $controller = new Passenger_Controller();
}elseif ($_GET['account_type']==1){
    $account_name = "conductor";
    $controller = new Conductor_Controller();
}elseif ($_GET['account_type']==2){
    $account_name = "executive";
    $controller = new Executive_Controller();
}

$errors=array();
if(isset($_POST['save'])){

    $details=array(
        $account_name.'_no'=>$_SESSION['account_no'],
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'email'=>$_POST['email'],
        'telephone'=>$_POST['telephone'],
    );

    $errors=$controller->validatedetails($details);
    $errors_str='';
    if(!empty($errors)){
        foreach ($errors as $error) {
            $errors_str.="*".$error."<br>";
        }
    }else{
        $errors_str="Success";
    }

}
if(isset($_POST['cpwd'])){
    header("Location: ../change_password.php?account_type=".$_GET['account_type']."");
    return;
}
if(isset($_POST['back'])){
    header("Location: ../".$account_name."_home.php");
    return;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form id="returndata" action="../edit_profile.php?account_type=<?=$_GET['account_type']?>" method="post">
    <input type="hidden" name="fname" value="<?php echo $_POST['fname']; ?>">
    <input type="hidden" name="lname" value="<?php echo $_POST['lname']; ?>">
    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="telephone" value="<?php echo $_POST['telephone']; ?>">
    <input type="hidden" name="error_str" value="<?php echo $errors_str; ?>">
    <input type="hidden" name="sub" value="finish">

</form>
<script type="text/javascript">
    document.getElementById('returndata').submit();
</script>
</body>
</html>
