<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if ($_GET["conductor_id"]) {
    
    $conductor_id = $_GET["conductor_id"];

    require_once "../class/Model/dbh.class.php";

    $ctrl_obj = new Board_Manager_Controller();

    $ctrl_obj->remove_Conductor($conductor_id);

    $error= "Conductor Removed Successfully!!";
    header("Location: ../board_manager_conductor_details.php?show={$error}");
    return;
}

?>