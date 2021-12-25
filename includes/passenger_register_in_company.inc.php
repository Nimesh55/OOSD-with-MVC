<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";
$passenger_controller = new Passenger_Controller();
if (isset($_POST['request'])){
    $passenger_controller->setCompanyDetails($_POST['service_no'],$_POST['staff_id']);
    header("Location:../passenger_register_in_company.php");
}
if(isset($_POST['remove'])){
    $passenger_controller->unSetCompanyDetails();
    header("Location:../passenger_register_in_company.php");
}
