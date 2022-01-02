<?php 

session_start();

if (isset($_GET['booking_no'])) {
    
    $booking_no = $_GET['booking_no'];
    
    // Instanciate Conductor Controller in MVC
    require_once "../class/dbh.class.php";
    require_once "../class/conductor.class.php";
    require_once "../class/conductor_controller.class.php";
    require_once "../class/conductor_model.class.php";

    $conductor_ctrl = new Conductor_Controller();
    $bookingObj = $conductor_ctrl->cancelBooking($booking_no);

    $error = "Booking Removed Succesfully!!";
    header("Location: ../conductor_cancel_booking_view.php?booking_no='{$booking_no}'&error='{$error}'");
    return;
}

?>