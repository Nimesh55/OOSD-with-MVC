<?php

if(isset($_POST['submit'])){

    // fetching data
    $firstname = htmlentities($_POST["Firstname"]);
    $lastname = htmlentities($_POST["Lastname"]);
    $uid = htmlentities($_POST["ID"]);
    $address = htmlentities($_POST["Address"]);
    $email = htmlentities($_POST["email"]);
    $telephone = htmlentities($_POST["Telephone"]);
    $password = htmlentities($_POST["password"]);
    $passwordrepeat = htmlentities($_POST["passwordrepeat"]);

    // Instanciate Signup Controller in MVC
    include "../class/dbh.class.php";
    include "../class/signup.class.php";
    include "../class/signup_ctrl.class.php";
    
    header("location: ../test.php?error=start");

    $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $passwordrepeat, NULL,NULL);

    

    // Run add user 
    $signupctrlobj->signupUser();

    header("location: ../test.php?error=alldone");
}