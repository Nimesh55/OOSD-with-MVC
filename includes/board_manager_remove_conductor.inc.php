<?php 

session_start();

if ($_GET["conductor_id"]) {
    
    $conductor_id = $_GET["conductor_id"];

    require_once "../class/dbh.class.php";
    require_once "../class/board_manager.class.php";
    require_once "../class/board_manager_controller.class.php";

    $ctrl_obj = new Board_Manager_Controller();

    $ctrl_obj->remove_Conductor($conductor_id);

    $error= "Conductor Removed Successfully!!";
    header("Location: ../board_manager_conductor_details.php?show={$error}");
    return;
}

?>