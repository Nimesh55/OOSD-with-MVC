<?php 

session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";

if (isset($_POST['submit'])) {
    
    // fetch conductor id
    $conductor_id = htmlentities($_POST['conductor_id']);

    

    $ctrl_obj = new Board_Manager_Controller();

    $error = $ctrl_obj->validateConductorID($conductor_id);

    if($error=="None"){
        header("Location: ../board_manager_conductor_details.php?show=success&conductor_id='{$conductor_id}'");
        return;
    }
    else{
        header("Location: ../board_manager_conductor_details.php?show=$error");
        return;
    }

    

}

?>