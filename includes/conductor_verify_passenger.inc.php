<?php



if (isset($_POST['submit'])) {

    // fetch passenger id
    $passenger_id = htmlentities($_POST['passenger_id']);

    // Instanciate Passenger Controller in MVC
    require_once "../class/dbh.class.php";
    require_once "../class/conductor.class.php";
    require_once "../class/conductor_controller.class.php";
    require_once "../class/conductor_model.class.php";
    
    echo "<pre>";
    print_r($_POST);
    echo"</pre>";
    $conductor_ctrl_obj = new Conductor_Controller();
    $conductor_ctrl_obj->setPassengerId($passenger_id);
    

    echo "<pre>";
    print_r($conductor_ctrl_obj);
    echo "</pre>";


    $conductor_ctrl_obj->verifyPassgenger();
}