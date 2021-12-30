<?php 

session_start();


if (isset($_POST['submit'])) {
    
    // fetch conductor id
    $conductor_id = htmlentities($_POST['conductor_id']);

    // Instanciate Passenger Controller in MVC
    require_once "../class/dbh.class.php";
    require_once "../class/board_manager.class.php";
    require_once "../class/board_manager_controller.class.php";
    require_once "../class/board_manager_model.class.php";

    $ctrl_obj = new Board_Manager_Controller();

    $error = $ctrl_obj->validateConductorID($conductor_id);

    if($error=="None"){
        header("Location: ../board_manager_conductor_details.php?show=success&conductor_id='{$conductor_id}'");
        return;
    }
    else{
        header("Location: ../board_manager_conductor_details.php?show='{$error}'");
        return;
    }

    

}

?>