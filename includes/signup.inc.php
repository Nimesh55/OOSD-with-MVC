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

    //By throwing relevant values, make relevant signup class according to account type
    if($_GET['account_type']==0){
      $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $passwordrepeat, NULL,NULL,0);
    }elseif ($_GET['account_type']==1) {
      // Create signup controller according to the conductor account type
      exit();
    }else {
      $company_name = htmlentities($_POST["Companyname"]);
      $company_Id = htmlentities($_POST["Companyid"]);
      $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $passwordrepeat, $company_name,$company_Id,2);
    }



    // Run add user
    $signupctrlobj->signupUser();
}
