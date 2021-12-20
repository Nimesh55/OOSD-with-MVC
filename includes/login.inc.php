<?php
if(isset($_POST['submit'])){

    // fetching data

    $uid = htmlentities($_POST["id"]);
    $password = htmlentities($_POST["password"]);

    // Instanciate Signup Controller in MVC
    include "../class/dbh.class.php";
    include "../class/login.class.php";
    include "../class/login_ctrl.class.php";
    
    $loginctrlobj = new Login_Controller($uid, $password);

    // Run add user 
    $loginctrlobj->loginUser();
}