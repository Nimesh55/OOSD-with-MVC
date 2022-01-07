<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();
if (isset($_POST['submit']) && $_POST['submit']=='Submit') {
    $passenger_request_pass_controller = new Passenger_Request_Pass_Controller();
    $pass_tracker = Pass_tracker::getInstance();
    $details = array(
        'passenger_no' => $_POST['passenger_no'],
        'service_no' => $_SESSION['service_no'],
        'start_date' => $_POST['from_date'],
        'end_date' => $_POST['to_date'],
        'bus_route' => $_POST['bus_route'],
        'reason' => $_POST['reason']
    );

    $errors = $passenger_request_pass_controller->validate($details);
    $url_extention = "passenger_no={$details['passenger_no']}&";
    $url_extention .= "reason={$details['reason']}&";
    $url_extention .= "start_date={$details['start_date']}&";
    $url_extention .= "end_date={$details['end_date']}&";
    $url_extention .= "bus_route={$details['bus_route']}&";
    $url_extention .= "error={$errors}";
    if (!strcmp($errors, "success") != 0) {
        $pass = $pass_tracker->createPass($details);
    }
    $pass_tracker->upgradePassState($pass->getPassNo());
    header("Location: ../executive_create_pass_manually.php?{$url_extention}");
}
if (isset($_POST['exit'])){
    header("Location: ../executive_pass_details.php");
}