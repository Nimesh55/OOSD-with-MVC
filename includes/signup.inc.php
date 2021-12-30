<?php

if(isset($_POST['submit'])){
    //####make sure to pass the $_GET['src']
    // fetching data
    $firstname = htmlentities($_POST["Firstname"]);
    $lastname = htmlentities($_POST["Lastname"]);
    $uid = htmlentities($_POST["ID"]);
    $address = htmlentities($_POST["Address"]);
    $email = htmlentities($_POST["email"]);
    $telephone = htmlentities($_POST["Telephone"]);

    // Instanciate Signup Controller in MVC
    include "../class/dbh.class.php";
    include "../class/signup.class.php";
    include "../class/signup_controller.class.php";

    //By throwing relevant values, make relevant signup class according to account type
    if($_GET['account_type']==0){
        $password = htmlentities($_POST["password"]);
        $password_repeat = htmlentities($_POST["passwordrepeat"]);
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, NULL,NULL, NULL, NULL, 0);
    }elseif ($_GET['account_type']==1) {
        $vehicle_no = htmlentities($_POST["vehicle_no"]);
        $district = htmlentities($_POST["district"]);
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, "abcd", "abcd", NULL,NULL, $vehicle_no, $district,1);
    }else {
        $password = htmlentities($_POST["password"]);
        $password_repeat = htmlentities($_POST["passwordrepeat"]);
        $company_name = htmlentities($_POST["Companyname"]);
        $company_Id = htmlentities($_POST["Companyid"]);
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, $company_name,$company_Id, NULL, NULL,2);
    }
    
    // Run add user
    $signupctrlobj->signupUser();
}
