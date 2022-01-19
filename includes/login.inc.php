<?php
if(isset($_POST['submit'])){

    // fetching data

    $uid = htmlentities($_POST["id"]);
    $password = htmlentities($_POST["password"]);

    // Instanciate Signup Controller in MVC

    require_once $_SERVER['DOCUMENT_ROOT'] . "/OOSD-with-MVC/includes/autoloader.inc.php";

    
    $loginctrlobj = new Login_Controller($uid, $password);

    // Run add user 
    $loginctrlobj->loginUser();
}