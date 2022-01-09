<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

session_start();

if($_GET['action'] == 0){
    Booking_Controller::getInstance()->setStateCanelled($_GET['booking_no']);
    header("Location: ../board_manager_allocate_vehicle.php");
}elseif($_GET['action'] == 1){
    header("Location: ../board_manager_allocate_vehicle_select.php?booking_no={$_GET['booking_no']}&pickup={$_GET['pickup']}");
}elseif($_GET['action'] == 2){
    $board_manager_ctrl = new Board_Manager_Controller();
    $board_manager_ctrl->allocateConductorForBooking($_GET['booking_no'], $_GET['conductor_no']);

    header("Location: ../board_manager_allocate_vehicle.php");
}