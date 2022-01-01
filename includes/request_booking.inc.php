<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if($_POST['request'] == "Request"){
    $details = array(
        "service_no" => $_SESSION["service_no"],
        "reason" => htmlentities($_POST["reason"]),
        "start_date" => $_POST["start_date"],
        "end_date" => $_POST["end_date"],
        "start_time" => $_POST["start_time"],
        "end_time" => $_POST["end_time"],
        "pickup_district" => $_POST["start_dist"],
        "pickup_location" => htmlentities($_POST["pickup_loc"]),
        "destination_district" => $_POST["end_dist"],
        "destination_location" => htmlentities($_POST["destination_loc"]),
        "passenger_count" => htmlentities($_POST["passenger_count"]));

    $executive_ctrl = new Executive_Controller();
    $executive_ctrl->requestBooking($details);
}else{
    header("Location: ../executive_booking_details.php");
}