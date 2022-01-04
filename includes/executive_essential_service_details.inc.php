<?php 

require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
if (isset($_POST['variablePass1'])) {
    $str =  $_POST['variablePass1'];
    $seperatedButtonInput = explode("-", $str);
    $button_state = $seperatedButtonInput[0];
    $button_service_no = $seperatedButtonInput[1];

    //echo $button_service_no;

    $ctrl_obj = new Executive_Controller();
    if ($button_state == 0) {
        print_r($_FILES);
        exit();
        // echo "Yahoo";
        // echo $button_service_no;
        $ctrl_obj->setEssentialServiceState(0, $button_service_no);
        $ctrl_obj->setExecutiveState(0, $button_service_no);
    }
    elseif($button_state == 1)
    {
        //echo "No= ".$button_service_no;
        print_r($_FILES);
        exit();
        $ctrl_obj->setEssentialServiceState(1, $button_service_no);
        $ctrl_obj->setExecutiveState(1, $button_service_no);
    }

    header("Location: ../executive_essential_service_details.php");
    return;
}



?>