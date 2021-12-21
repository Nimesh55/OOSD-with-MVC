<?php
require_once "includes/autoloader.inc.php";
session_start();

if(!isset($_SESSION['account_no'])){
    header("Location: login.php");
    return;
}



  $passengerview = new PassengerView($_SESSION['account_no']);
  $details = $PassengerView->getDetails();

  echo "<pre>";
  print_r($detail);
  echo "</pre>";

// if($row['state'] == '0'){
//     $state = 0;
// }elseif($row['state'] == '1'){
//     $state = 1;
// }else{
//     $state = 2;
// }

?>
