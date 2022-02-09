<?php
require_once "../class/model/dbh.class.php";
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
    }elseif(Timer::getInstance()->my_date_diff($currDate, $leave_date, 30)){
        $error = "Maximum of 30 days is Allowed";
        header("Location: ../board_manager_add_conductor_leave.php?error=$error");
        return;
    }

    $conductor_ctrl_obj->updateLeave($_SESSION['account_no'], $leave_date, "booked");
}
elseif (isset($_POST['submit_manual'])) {

    $leave_date = $_POST['leave_date'];

    // Instanciate Conductor Controller in MVC


    $conductor_ctrl_obj = new Conductor_Controller();
    $currDate = $conductor_ctrl_obj->getCurrentDate();

    if ($conductor_ctrl_obj->checkEmpty($leave_date) == false) {
        $error = "Empty Field. Please Select a date!!";
        header("Location: ../board_manager_add_conductor_leave.php?error=$error");
        return;
    }elseif($leave_date<$currDate){
        $error = "Date has already passed!!";
        header("Location: ../board_manager_add_conductor_leave.php?error=$error");
        return;
    }elseif(Timer::getInstance()->my_date_diff($currDate, $leave_date, 30)){
        $error = "Maximum of 30 days is Allowed";
        header("Location: ../board_manager_add_conductor_leave.php?error=$error");
        return;
    }

    $conductor_ctrl_obj->updateLeaveManual($_SESSION['conductor_no'], $leave_date, "booked");
    unset($_SESSION['conductor_no']);
}
elseif(isset($_POST['cancel'])){
    header("Location:../board_manager_conductor_details.php?show=none");
}
elseif(isset($_GET['conductor_id'])){
    $_SESSION['conductor_id'] = $_GET['conductor_id'];
    header("Location:../board_manager_add_conductor_leave.php?error=none");
}
