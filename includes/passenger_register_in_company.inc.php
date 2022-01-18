<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();
$error = '';
$passenger_controller = new Passenger_Controller();
if (isset($_POST['request'])){
    if (empty($_POST['staff_id'])){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $error = "identified";
    }else {
        $passenger_controller->setPassengerCompanyDetails($_POST['service_no'], $_POST['staff_id']);

    }
}
if(isset($_POST['remove'])){
    $passenger_controller->unSetPassengerCompanyDetails();
    header("Location:../passenger_register_in_company.php");
}
if(isset($_POST['home'])){
    header("Location:../passenger_home.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form id="returndata" action="../passenger_register_in_company.php" method="post">
      <input type="hidden" name="service_no" value="<?php echo $_POST['service_no']; ?>">
      <input type="hidden" name="error" value="<?php echo $error; ?>">

    </form>
    <script type="text/javascript">
    document.getElementById('returndata').submit();
    </script>
  </body>
</html>