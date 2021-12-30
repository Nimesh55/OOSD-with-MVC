<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

if($_GET['action'] == 0){
    // implement here to decline booking
    Booking_Controller::getInstance()->setStateCanelled($_GET['booking_no']);
    header("Location: ../board_manager_allocate_vehicle.php");
}elseif($_GET['action'] == 1){
    header("Location: ../board_manager_allocate_vehicle_select.php?booking_no={$_GET['booking_no']}");
}elseif($_GET['action'] == 2){
    $board_manager = new Board_Manager_Controller();
    // implement here to book a vehicle for given booking

    header("Location: ../board_manager_allocate_vehicle.php");
}