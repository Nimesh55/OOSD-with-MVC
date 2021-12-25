<?php



if (isset($_POST['submit'])) {

    // fetch passenger id
    $passenger_id = htmlentities($_POST['passenger_id']);

    // Instanciate Passenger Controller in MVC
    require_once "../class/dbh.class.php";
    require_once "../class/conductor.class.php";
    require_once "../class/conductor_controller.class.php";
    require_once "../class/conductor_model.class.php";
    
    
    $conductor_ctrl_obj = new Conductor_Controller();
    $conductor_ctrl_obj->setPassengerId($passenger_id);

    $arrObj = $conductor_ctrl_obj->verifyPassgenger();
    $pName =  $arrObj["passengerName"];
    // $companyName = 
    // $route = 
    // $timePeriod = 
    // Implement this after tracker

    header("Location: ../conductor_verify_passenger.php?show=success&pName='{$pName}'");
    return;
}