<?php

if(isset($_POST['submit'])){
    // fetching data
    $firstname = htmlentities($_POST["Firstname"]);
    $lastname = htmlentities($_POST["Lastname"]);
    $uid = htmlentities($_POST["ID"]);
    $address = htmlentities($_POST["Address"]);
    $email = htmlentities($_POST["email"]);
    $telephone = htmlentities($_POST["Telephone"]);

    // Instanciate Signup Controller in MVC
    require_once "../class/Model/dbh.class.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/OOSD-with-MVC/includes/autoloader.inc.php";
//    include "../class/signup.class.php";
//    include "../class/signup_controller.class.php";

    //By throwing relevant values, make relevant signup class according to account type
    if($_GET['account_type']==0){
        $password = htmlentities($_POST["password"]);
        $password_repeat = htmlentities($_POST["passwordrepeat"]);
        $company = 0;
        $staffId = 0;
        if(isset($_POST['variable2'])){
            $company = $_POST['variable2'];
            $staffId = htmlentities($_POST["staffId"]);
        }
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, $company,$staffId, NULL, NULL, 0,NULL);
    }elseif ($_GET['account_type']==1) {
        $vehicle_no = htmlentities($_POST["vehicle_no"]);
        $district = htmlentities($_POST["district"]);
        $seats = htmlentities($_POST["seats"]);
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, "abcd", "abcd", NULL,NULL, $vehicle_no, $district,1,$seats);
    }else {
        $password = htmlentities($_POST["password"]);
        $password_repeat = htmlentities($_POST["passwordrepeat"]);
        $company_name = htmlentities($_POST["Companyname"]);
        $company_Id = htmlentities($_POST["Companyid"]);
        $signupctrlobj = new Signup_Controller($firstname, $lastname, $uid, $address, $email, $telephone, $password, $password_repeat, $company_name,$company_Id, NULL, NULL,2,NULL);
    }
    
    // Run add user
    $signupctrlobj->signupUser();
}
