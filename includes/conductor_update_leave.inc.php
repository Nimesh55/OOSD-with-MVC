<?php

session_start();

if (isset($_POST['submit'])) {

    $leave_date = $_POST['leave_date'];

    // Instanciate Conductor Controller in MVC
    require_once "../class/dbh.class.php";
    require_once "../class/conductor.class.php";
    require_once "../class/conductor_controller.class.php";
    require_once "../class/conductor_model.class.php";

    $conductor_ctrl_obj = new Conductor_Controller();

    if ($conductor_ctrl_obj->checkEmpty($leave_date) == false) {
        $error = "Empty Field. Please Select a date!!";
        header("Location: ../conductor_update_leave.php?error='{$error}'");
        return;
    }
    //echo $_SESSION['account_no'];
    $conductor_ctrl_obj->updateLeave($_SESSION['account_no'], $leave_date, "booked");
}
