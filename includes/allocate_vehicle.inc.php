<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

session_start();
if (isset($_POST['variablePass1'])) {
    $var = $_POST['variablePass1'];
    $seperatedButtonInput = explode("-", $var);
    $action = $seperatedButtonInput[0];
    $bookingNo = $seperatedButtonInput[1];
    $param_2 = $seperatedButtonInput[2]; // Pickup districs or conductor_no
}

if ($action == 0) {
    Booking_Controller::getInstance()->setStateCanelled($bookingNo);
    header("Location: ../board_manager_allocate_vehicle.php");
} elseif ($action == 1) {
    header("Location: ../board_manager_allocate_vehicle_select.php?booking_no={$bookingNo}&pickup={$param_2}");
} elseif ($action == 2) {
    $board_manager_ctrl = new Board_Manager_Controller();
    $board_manager_ctrl->allocateConductorForBooking($bookingNo, $param_2);

}
