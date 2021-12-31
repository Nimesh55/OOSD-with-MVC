<?php
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
if (isset($_POST['variablePass1'])) {
    $str = $_POST['variablePass1'];
    $seperatedButtonInput = explode("-", $str);
    $button_state = $seperatedButtonInput[0];
    $button_Pass_no = $seperatedButtonInput[1];
    echo $button_state ;
    echo "-______-";
    echo $button_Pass_no ;
    $exec_ctrl = new Executive_Controller();
    if ($button_state == 1) {
        echo "Approve";
        $exec_ctrl->approvePass($button_Pass_no);
    }
    elseif($button_state == 4){
        echo"decline";
        $exec_ctrl->declinePass($button_Pass_no);
    }

}