<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

$board_manager_controller = new Board_Manager_Controller();
if($_GET['action']=="accept"){
    $board_manager_controller->approvePass($_GET['pass_no']);
}elseif ($_GET['action']=="decline"){
    $board_manager_controller->declinePass($_GET['pass_no']);
}elseif ($_GET['action']=="remove"){
    $board_manager_controller->removePass($_GET['pass_no']);
}