<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}
$errors=array();
if(isset($_POST['save'])){


    $passenger_controller=new Passenger_Controller($_SESSION['account_no']);
    $details=array(
        'passenger_no'=>$_SESSION['account_no'],
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'email'=>$_POST['email'],
        'telephone'=>$_POST['telephone'],
    );

    $errors=$passenger_controller->validatedetails($details);
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
    header("Location: ../passenger_home.php");
    return;
}
if(isset($_POST['back'])){
    header("Location: ../passenger_home.php");
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
    <form id="returndata" action="../passenger_edit_profile.php" method="post">
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
