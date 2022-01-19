<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

if(isset($_POST['variablePass1']) && !isset($_POST['pwd'])){
    requestOrRemove();
}

if(isset($_POST['back'])){
    header("Location: ../executive_essential_service_details.php");
}

if(isset($_POST['enter'])){
    $executive_controller = new Executive_Controller();
    if($executive_controller->checkExecutivePassword($_POST['user_id'],$_POST['password'])){
        requestOrRemove();
    }else{
        $_SESSION['variablePass1']=$_POST['variablePass1'];
        header("Location: ../executive_remove_essetial_service_verification.php?error=password_error");
    }

}
function requestOrRemove()
{
    if (isset($_POST['variablePass1'])) {
        $str = $_POST['variablePass1'];
        $seperatedButtonInput = explode("-", $str);
        $button_state = $seperatedButtonInput[0];
        $button_service_no = $seperatedButtonInput[1];

        $ctrl_obj = new Executive_Controller();
        if ($button_state == 0) {
            $ctrl_obj->setEssentialServiceState(0, $button_service_no);
            $ctrl_obj->setExecutiveState(0, $button_service_no);

        } elseif ($button_state == 1) {
            $ctrl_obj->setEssentialServiceState(1, $button_service_no);
            $ctrl_obj->setExecutiveState(1, $button_service_no);
        }

        header("Location: ../executive_essential_service_details.php");
    }
}


?>

