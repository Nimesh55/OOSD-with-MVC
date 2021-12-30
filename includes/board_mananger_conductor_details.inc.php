<?php 

session_start();


if (isset($_POST['submit'])) {
    
    $conductor_id = htmlentities($_POST['conductor_id']);

    header("Location: ../board_manager_conductor_details.php?show=success&conductor_id='{$conductor_id}'");
    return;

}

?>