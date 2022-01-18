<?php
require_once "../class/dbh.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";
session_start();

if (isset($_POST['submit'])) {

    $leave_date = $_POST['leave_date'];

    // Instanciate Conductor Controller in MVC
    

    $conductor_ctrl_obj = new Conductor_Controller();
    $currDate = $conductor_ctrl_obj->getCurrentDate();

    if ($conductor_ctrl_obj->checkEmpty($leave_date) == false) {
        $error = "Empty Field. Please Select a date!!";
        header("Location: ../conductor_update_leave.php?error=$error");
        return;
    }elseif($leave_date<$currDate){
        $error = "Date has already passed!!";
        header("Location: ../conductor_update_leave.php?error=$error");
        return;
    }

    $conductor_ctrl_obj->updateLeave($_SESSION['account_no'], $leave_date, "booked");
}
