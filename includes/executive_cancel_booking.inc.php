<?php

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

if(isset($_POST['cancel'])){
    $executive_ctrl = new Executive_Controller();
    $executive_ctrl->setBookingCompleted($_POST['booking_no']);
    header("Location:../executive_booking_details.php");
}

if(isset($_POST['exit'])){
    header("Location:../executive_booking_details.php");
}