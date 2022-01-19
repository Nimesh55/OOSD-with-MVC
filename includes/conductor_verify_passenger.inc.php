<?php
session_start();
require_once "../class/Model/dbh.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

if (isset($_POST['submit'])) {

    // fetch passenger id
    $passenger_id = htmlentities($_POST['passenger_id']);

    // // Instanciate Passenger Controller in MVC
    
    // require_once "../class/conductor.class.php";
    // require_once "../class/Controller/conductor_controller.class.php";
    // require_once "../class/Model/conductor_model.class.php";
    
    
    $conductor_ctrl_obj = new Conductor_Controller();
    
    $error = $conductor_ctrl_obj->validatePassengerId($passenger_id);

    if($error=="None"){
        header("Location: ../conductor_verify_passenger.php?show=success&passenger_id='{$passenger_id}'");
        return;
    }
    else{
        header("Location: ../conductor_verify_passenger.php?show=$error");
        return;
    }
}