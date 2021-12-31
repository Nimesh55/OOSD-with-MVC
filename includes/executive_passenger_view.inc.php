<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
if (isset($_POST['variablePass1'])) {
    $str = $_POST['variablePass1'];
    $seperatedButtonInput = explode("-", $str);
    $button_state = $seperatedButtonInput[0];
    $button_Passenger_no = $seperatedButtonInput[1];
    echo $button_state;
    echo "--";
    echo $button_Passenger_no;
    $exec_ctrl = new Executive_Controller();
    $exec_ctrl->setPassengerState($button_state, $button_Passenger_no);
}